# SuiteCRM Click to Call (Asterisk)



## Instalación

Para instalar el módulo hay que entrar en la administración de SuiteCRM y entrar en "Module Loader" seleccionar y subir el **.zip**. Una vez subido correctamente, solo queda dar click en instalar.

> Para generar el "**.zip**" de instalación, es necesario hacer un clon del proyecto y comprimir el código en el primer nivel o se puede descargar desde los archivos adjuntos en la release "**suite-crm-click-to-call.zip**"

## Configuración

Tras la instalación, en la administración esta la nueva sección de "**SuiteCRM Click to Call (Asterisk)**" donde se configurara la conexión con Asterisk.

| Campo | Descripción | Ejemplo |
|-|-|-|
| **IP** | Dirección IP o URL de Asterisk | 127.0.0.1 |
| **Port**| Puerto del manager de Asterisk (por defecto **5038**) | 5038 |
| **User**| Usuario del manager de Asterisk | admin |
| **Password**| Contraseña del manager de Asterisk| asteriksecret |
| **Channel In**| local/SIP| local |
| **Channel In Context**| Contexto dependiente de Channel In (local) | from-users |
| **Channel Out**| local | local |
| **Channel Our Context**:| Contexto para las llamadas salientes | from-users |
| **Caller ID**:| | 0 |
| **Variables**: | Variables para utilizar en los contextos | var_extension=$extension;var_num_llamar=$numberCall |

En la configuración de usuarios, se ha crea el campo "**Asterisk Extension**" donde cada usuario pondrá su extensión correspondiente para realizar la llamada.

## Uso

Los campos que sean de tipo "**phone**" ya sea en la ficha o en los listados de los diferentes módulos, tendrán a su derecha un ícono de un teléfono que al dar click este, enviara la señal de llamada al teléfono de la extensión del usuarios y posteriormente realizara la llamada.
