<form method="POST" action="index.php" enctype="multipart/form-data">

    <input type="hidden" name="module" value="ClickToCall" />
    <input type="hidden" name="action" value="index" />

    <span class="error">{$error.main}</span>

    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_IP}</td>
            <td>
                {if empty($config.clicktocall_asterisk_ip)}
                    {assign var='clicktocall_asterisk_ip' value=$clicktocall_config.clicktocall_asterisk_ip.default}
                {else}
                    {assign var='clicktocall_asterisk_ip' value=$config.clicktocall_asterisk_ip}
                {/if}
                <input
                    type="text"
                    name="clicktocall_asterisk_ip"
                    size="45"
                    value="{$clicktocall_asterisk_ip}"
                    placeholder="{$clicktocall_config.clicktocall_asterisk_ip.placeholder}" />
            </td>

            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_PORT}</td>
            <td>

                {if empty($config.clicktocall_asterisk_port)}
                    {assign var='clicktocall_asterisk_port' value=$clicktocall_config.clicktocall_asterisk_port.default}
                {else}
                    {assign var='clicktocall_asterisk_port' value=$config.clicktocall_asterisk_port}
                {/if}
                <input
                    type="text"
                    name="clicktocall_asterisk_port"
                    size="45"
                    value="{$clicktocall_asterisk_port}"
                    placeholder="{$clicktocall_config.clicktocall_asterisk_port.placeholder}" />

            </td>
        </tr>

        <tr>
            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_USER}</td>
            <td>
                {if empty($config.clicktocall_asterisk_user)}
                    {assign var='clicktocall_asterisk_user' value=$clicktocall_config.clicktocall_asterisk_user.default}
                {else}
                    {assign var='clicktocall_asterisk_user' value=$config.clicktocall_asterisk_user}
                {/if}
                <input
                    type="text"
                    name="clicktocall_asterisk_user"
                    size="45"
                    value="{$clicktocall_asterisk_user}"
                    placeholder="{$clicktocall_config.clicktocall_asterisk_user.placeholder}" />
            </td>

            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_PASS}</td>
            <td>

                {if empty($config.clicktocall_asterisk_pass)}
                    {assign var='clicktocall_asterisk_pass' value=$clicktocall_config.clicktocall_asterisk_pass.default}
                {else}
                    {assign var='clicktocall_asterisk_pass' value=$config.clicktocall_asterisk_pass}
                {/if}
                <input
                    type="password"
                    name="clicktocall_asterisk_pass"
                    size="45"
                    value="{$clicktocall_asterisk_pass}"
                    placeholder="{$clicktocall_config.clicktocall_asterisk_pass.placeholder}" />

            </td>
        </tr>

        <tr>
            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_CHANNELIN}</td>
            <td>
                {if empty($config.clicktocall_channelIn)}
                    {assign var='clicktocall_channelIn' value=$clicktocall_config.clicktocall_channelIn.default}
                {else}
                    {assign var='clicktocall_channelIn' value=$config.clicktocall_channelIn}
                {/if}

                <select name="clicktocall_channelIn">
                    <option value="local" {if $clicktocall_channelIn =='local'}selected{/if}>local</option>
                    <option value="SIP" {if $clicktocall_channelIn =='SIP'}selected{/if}>SIP</option>
                </select>

            </td>

            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_CHANNELINCONTEXT}</td>
            <td>

                {if empty($config.clicktocall_channelInContext)}
                    {assign var='clicktocall_channelInContext' value=$clicktocall_config.clicktocall_channelInContext.default}
                {else}
                    {assign var='clicktocall_channelInContext' value=$config.clicktocall_channelInContext}
                {/if}
                <input
                    type="text"
                    name="clicktocall_channelInContext"
                    size="45"
                    value="{$clicktocall_channelInContext}"
                    placeholder="{$clicktocall_config.clicktocall_channelInContext.placeholder}" />

            </td>
        </tr>

        <tr>
            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_CHANNELOUT}</td>
            <td>
                {if empty($config.clicktocall_channelOut)}
                    {assign var='clicktocall_channelOut' value=$clicktocall_config.clicktocall_channelOut.default}
                {else}
                    {assign var='clicktocall_channelOut' value=$config.clicktocall_channelOut}
                {/if}

                <select name="clicktocall_channelOut">
                    <option value="local" {if $clicktocall_channelOut =='local'}selected{/if}>local</option>
                </select>
            </td>

            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_CHANNELOUTCONTEXT}</td>

            <td>
                {if empty($config.clicktocall_channelOutContext)}
                    {assign var='clicktocall_channelOutContext' value=$clicktocall_config.clicktocall_channelOutContext.default}
                {else}
                    {assign var='clicktocall_channelOutContext' value=$config.clicktocall_channelOutContext}
                {/if}
                <input
                    type="text"
                    name="clicktocall_channelOutContext"
                    size="45"
                    value="{$clicktocall_channelOutContext}"
                    placeholder="{$clicktocall_config.clicktocall_channelOutContext.placeholder}" />
            </td>

        </tr>

        <tr>
            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_CALLERID}</td>
            <td>
                {if empty($config.clicktocall_callerId)}
                    {assign var='clicktocall_callerId' value=$clicktocall_config.clicktocall_callerId.default}
                {else}
                    {assign var='clicktocall_callerId' value=$config.clicktocall_callerId}
                {/if}
                <input
                    type="text"
                    name="clicktocall_callerId"
                    size="45"
                    value="{$clicktocall_callerId}"
                    placeholder="{$clicktocall_config.clicktocall_callerId.placeholder}" />
            </td>

            <td>{$MOD.LBL_CLICKTOCALL_ASTERISK_VARIABLES}</td>

            <td>
                {if empty($config.clicktocall_variables)}
                    {assign var='clicktocall_variables' value=$clicktocall_config.clicktocall_variables.default}
                {else}
                    {assign var='clicktocall_variables' value=$config.clicktocall_variables}
                {/if}
                <input
                    type="text"
                    name="clicktocall_variables"
                    size="45"
                    value="{$clicktocall_variables}"
                    placeholder="{$clicktocall_config.clicktocall_variables.placeholder}" />
            </td>

        </tr>

    </table>

    <br />

    <div>
        <input title="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button"  type="submit" name="save" value="{$APP.LBL_SAVE_BUTTON_LABEL}" />
        <input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}" onclick="document.location.href='index.php?module=Administration&action=index'" class="button" type="button" name="cancel" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" />
    </div>

</form>

