<?php

global $sugar_config;

$call = new ClickToCall();

$options = array(
    'clicktocall_asterisk_user' => 'setAsteriskUser',
    'clicktocall_asterisk_pass' => 'setAsteriskPass',
    'clicktocall_asterisk_ip' => 'setAsteriskIp',
    'clicktocall_asterisk_port' => 'setAsteriskPort',
    'clicktocall_channelIn' => 'setChannelIn',
    'clicktocall_channelInContext' => 'setChannelInContext',
    'clicktocall_channelOut' => 'setChannelOut',
    'clicktocall_channelOutContext' => 'setChannelOutContext',
    'clicktocall_callerId' => 'setCallerId',
    'clicktocall_variables' => 'setVariables'
);

foreach ($options as $option => $setter) {
    if (isset($sugar_config[$option])) {
        $value = $sugar_config[$option];
        $call->$setter($value);
    }
}

$call->setExtension($_POST['ext'])->setNumber($_POST['num']);
$call->call();

class ClickToCall
{

    protected $_asteriskUser;
    protected $_asteriskPass;
    protected $_asteriskIp;
    protected $_asteriskPort = 5038;

    protected $_channelIn;
    protected $_channelInContext;
    protected $_channelOut;
    protected $_channelOutContext;
    protected $_callerId;
    protected $_variables;

    protected $_timeOut = 5000;

    protected $_number = null;
    protected $_extension = null;

    public function __construct()
    {
        openlog('click-to-call', LOG_NDELAY | LOG_PID, LOG_LOCAL0);
    }

    public function __destruct()
    {
        closelog();
    }

    public function call()
    {

        $extension = $this->getExtension();
        $numberCall = $this->cleanNumber($this->getNumber());

        syslog(LOG_DEBUG, 'Start call');
        syslog(LOG_DEBUG, 'Asterisk: ' . $this->getAsteriskIp());
        syslog(LOG_DEBUG, 'Calling extension: ' . $extension);
        syslog(LOG_DEBUG, 'Number to call: ' . $numberCall);
        syslog(LOG_DEBUG, 'Channel In: ' . $this->getChannelIn());
        syslog(LOG_DEBUG, 'Channel Out: ' . $this->getChannelOut());

        $socket = fsockopen(
            $this->getAsteriskIp(),
            $this->getAsteriskPort(),
            $errno,
            $errstr,
            $this->getTimeOut()
        );

        $asteriskUser = $this->getAsteriskUser();
        $asteriskPassword = $this->getAsteriskPass();

        fputs($socket, "Action: Login\r\n");
        fputs($socket, "UserName: $asteriskUser\r\n");
        fputs($socket, "Secret: $asteriskPassword\r\n\r\n");

        $variables = str_replace(
            array('$extension', '$numberCall'),
            array($extension, $numberCall),
            $this->getVariables()
        );
        $variables = explode(';', $variables);

        $wrets = fgets($socket, 128);

        echo $wrets;

        $channel = '';
        if ($this->getChannelIn() === 'local') {
            $channel = $this->getChannelIn() . '/' . $extension . '@' . $this->getChannelInContext();
        } elseif ($this->getChannelIn() === 'SIP') {
            $channel = 'SIP/' . $extension;
        }

        fputs($socket, "Action: Originate\r\n");
        fputs($socket, "Channel: $channel\r\n");

        $callerId = $this->getCallerId();

        $channelOutContext = $this->getChannelOutContext();
        fputs($socket, "Exten: $numberCall\r\n");
        fputs($socket, "Context: $channelOutContext\r\n");
        fputs($socket, "Priority: 1\r\n");
        fputs($socket, "Async: yes\r\n");
        fputs($socket, "WaitTime: 25\r\n");
        fputs($socket, "Callerid: $callerId\r\n");

        if (!empty($variables)) {
            foreach ($variables as $val) {
                fputs($socket, "Variable: $val\r\n");
            }
        }

        fputs($socket, "Action: Logoff\r\n\r\n");

        $this->readResponse($socket, $this->getTimeOut());

        fclose($socket);

        if (!empty($errno)) {
            syslog(LOG_ERR, $errno);
            syslog(LOG_ERR, $errstr);
        }

    }

    public function readResponse($socket, $timeout = 5000)
    {

        $retVal = '';
        stream_set_timeout($socket, 0, $timeout);
        while (($buffer = fgets($socket, 20)) !== false) {
            $retVal .= $buffer;
        }

        syslog(LOG_DEBUG, '::-> readResponse :: ' . $retVal);

        return $retVal;
    }

    public function cleanNumber($number)
    {

        $num = trim($number);
        $num = str_replace(array(
            '-',
            ' ',
            '%',
            '+',
            '(',
            ')'
        ), '', $num);

        return $num;

    }

    public function setTimeOut($timeOut)
    {
        $this->_timeOut = $timeOut;
        return $this;
    }

    public function getTimeOut()
    {
        return $this->_timeOut;
    }

    public function setNumber($number)
    {
        $this->_number = $number;
        return $this;
    }

    public function getNumber()
    {
        return $this->_number;
    }

    public function setExtension($extension)
    {
        $this->_extension = $extension;
        return $this;
    }

    public function getExtension()
    {
        return $this->_extension;
    }

    public function setAsteriskUser($asteriskUser)
    {
        $this->_asteriskUser = $asteriskUser;
        return $this;
    }

    public function getAsteriskUser()
    {
        return $this->_asteriskUser;
    }

    public function setAsteriskPass($asteriskPass)
    {
        $this->_asteriskPass = $asteriskPass;
        return $this;
    }

    public function getAsteriskPass()
    {
        return $this->_asteriskPass;
    }

    public function setAsteriskIp($asteriskIp)
    {
        $this->_asteriskIp = $asteriskIp;
        return $this;
    }

    public function getAsteriskIp()
    {
        return $this->_asteriskIp;
    }

    public function setAsteriskPort($asteriskPort)
    {
        $this->_asteriskPort = $asteriskPort;
        return $this;
    }

    public function getAsteriskPort()
    {
        return $this->_asteriskPort;
    }

    public function setChannelIn($channelIn)
    {
        $this->_channelIn = $channelIn;
        return $this;
    }

    public function getChannelIn()
    {
        return $this->_channelIn;
    }

    public function setChannelInContext($channelInContext)
    {
        $this->_channelInContext = $channelInContext;
        return $this;
    }

    public function getChannelInContext()
    {
        return $this->_channelInContext;
    }

    public function setChannelOut($channelOut)
    {
        $this->_channelOut = $channelOut;
        return $this;
    }

    public function getChannelOut()
    {
        return $this->_channelOut;
    }

    public function setChannelOutContext($channelOutContext)
    {
        $this->_channelOutContext = $channelOutContext;
        return $this;
    }

    public function getChannelOutContext()
    {
        return $this->_channelOutContext;
    }

    public function setCallerId($callerId)
    {
        $this->_callerId = $callerId;
        return $this;
    }

    public function getCallerId()
    {
        return $this->_callerId;
    }

    public function setVariables($variables)
    {
        $this->_variables = $variables;
        return $this;
    }

    public function getVariables()
    {
        return $this->_variables;
    }

}

