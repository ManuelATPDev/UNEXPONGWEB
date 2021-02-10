<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';

$titulo = 'UNEXPO Núcleo Guarenas';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista de los avisos legales y contacto de la pagina-->
<div class="container-fluid text-center">
    <div class="jumbotron"> 
        <b>

            <div id="logo" class="col-lg-3 text-center">
                <img src="img/logounex.jpg" class="img-responsive" style="height: 100%; width: 100%">
            </div>

            <h2>Universidad Nacional Experimental Politécnica</h2>
            <h3>"Antonio José de Sucre"</h3>
            <h3>Núcleo Guarenas</h3>
            <h2>Síguenos en: @unexpoNGoficial</h2>
        </b>
    </div>
</div>

<!--Asi se realizan comentarios en html-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> !BIENVENIDO A LA UNEXPO!
                </div>
                <div class="panel-body text-justify">
                    <br>
                    <p>
                        En cumplimiento del  artículo 18 de la Ley de Infogobierno publicada en Gaceta Oficial No. 40.274 del 17 de octubre de 2013, con el objeto de establecer los principios, bases y lineamientos que regirán el uso de las tecnologías de información en el Poder Público y que establece que “Los órganos y entes del Poder Público y el Poder Popular, en el ejercicio de sus competencias, deben contar con un portal de internet bajo su control y administración. La integridad, veracidad y actualización de la información publicada y los servicios públicos que se presten a través de los portales es responsabilidad del titular del portal. La información contenida en los portales de internet tiene el mismo carácter oficial que la información impresa que emitan.” Se establece lo siguiente:
                    </p>
                    <hr>
                    <br>
                    <br>

                    <strong><p class="text-center">1. Datos identificativos</p></strong>

                    <p>Se pone en conocimiento de los usuarios del sitio web de la Universidad Nacional Experimental Politécnica "Antonio José de Sucre", www.unexpong.ve, la siguiente información:</p>



                    <p>El sitio web www.unexpong.ve es titularidad de la Universidad Nacional Experimental Politécnica "Antonio José de Sucre", con domicilio en Av. Principal Vicente Emilio Sojo, Guarenas, Miranda, Venezuela. Código Postal: 1220. Rif: G-20000167-4.</p>



                    <p>Los usuarios podrán establecer una comunicación directa y efectiva con la Universidad Nacional Experimental Politécnica "Antonio José de Sucre" mediante comunicación escrita remitida a la dirección antes indicada o por medio del teléfono: 0212-3623757.</p>

                    <br>
                    <br>

                    <strong><p class="text-center"> 2. Usuarios</p></strong>

                    <p>El acceso y uso de esta página Web y de todas las asociadas a la Universidad Nacional Experimental Politécnica "Antonio José de Sucre" correspondientes a sus Facultades, Escuelas, Departamentos e Institutos, Dependencias y demás Órganos (en adelante el Portal) atribuye a quien lo realiza la condición de USUARIO e implica la aceptación de todos y cada uno de los términos que se recogen en las presentes Condiciones Generales, sin perjuicio de que el acceso a alguno de los servicios o contenidos que a través de dichas páginas se puedan obtener pudiera estar sujeto a la aceptación de unas Condiciones Particulares adicionales.</p>

                    <br>
                    <br>

                    <strong><p class="text-center">3. Uso del portal web</p></strong>

                    <p> www.unexpong.ve proporciona el acceso a multitud de informaciones, servicios, programas o datos (en adelante, "los contenidos") en Internet pertenecientes a la Universidad Nacional Experimental Politécnica "Antonio José de Sucre" a los que el USUARIO pueda tener acceso. El USUARIO asume la responsabilidad del uso del portal y se compromete a hacer un uso adecuado de los contenidos y servicios que la Universidad Nacional Experimental Politécnica "Antonio José de Sucre" ofrece a través de su portal.</p>

                    <p>La Universidad Nacional Experimental Politécnica "Antonio José de Sucre" se reserva el derecho de retirar todos aquellos comentarios y aportaciones que vulneren el respeto a la dignidad de la persona, que sean discriminatorios, xenófobos, racistas, pornográficos, que atenten contra la juventud o la infancia, el orden o la seguridad pública o que, a su juicio, no resultaran adecuados para su publicación. En cualquier caso, la Universidad Nacional Experimental Politécnica "Antonio José de Sucre" no será responsable de las opiniones vertidas por los usuarios a través de los foros, chats, u otras herramientas de participación.</p>

                    <br>
                    <br>

                    <strong><p class="text-center">4. Protección de datos</p></strong>

                    <p>La Universidad Nacional Experimental Politécnica "Antonio José de Sucre" cumple con las directrices del artículo 25 de la Ley de Infogobierno que establece la obligación de protección de datos personales de los órganos y entes del Poder Público que hacen uso de la tecnología de información y demás normativas vigentes en la materia</p>

                    <br>
                    <br>

                    <strong><p class="text-center">5. Propiedad intelectual e industrial</p></strong>

                    <p>La Universidad Nacional Experimental Politécnica "Antonio José de Sucre", por sí o como cesionaria, es titular de todos los derechos de propiedad intelectual e industrial de su página web, así como de los elementos contenidos en la misma (a título enunciativo, imágenes, sonido, audio, vídeo, software o textos, marcas o logotipos, combinaciones de colores, estructura y diseño, selección de materiales usados, programas de computación necesarios para su funcionamiento, acceso y uso, etc. Todos los derechos reservados.</p>

                    <p>Cualquier uso no autorizado previamente por la Universidad Nacional Experimental Politécnica "Antonio José de Sucre", será considerado un incumplimiento grave de los derechos de propiedad intelectual o industrial del autor.</p>

                    <p>Quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de la totalidad o parte de los contenidos de esta página web, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización de la Universidad Nacional Experimental Politécnica "Antonio José de Sucre".</p>

                    <p>El USUARIO se compromete a respetar los derechos de Propiedad Intelectual e Industrial titularidad de la Universidad Nacional Experimental Politécnica "Antonio José de Sucre". Podrá visualizar los elementos del portal e incluso imprimirlos, copiarlos y almacenarlos en el disco duro de su computador o en cualquier otro soporte físico siempre y cuando sea, única y exclusivamente, para su uso personal y privado. El USUARIO deberá abstenerse de suprimir, alterar, eludir o manipular cualquier dispositivo de protección o sistema de seguridad que estuviera instalado en las páginas de la web de la Universidad Nacional Experimental Politécnica "Antonio José de Sucre".</p>

                    <br>
                    <br>

                    <strong><p class="text-center">6. Exclusión de garantías y responsabilidad</p></strong>

                    <p>La Universidad Nacional Experimental Politécnica "Antonio José de Sucre" no se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza que pudieran ocasionarse a terceros, a título enunciativo: errores u omisiones en los contenidos, falta de disponibilidad del portal o la transmisión de virus o programas maliciosos o lesivos en los contenidos, a pesar de haber adoptado todas las medidas tecnológicas necesarias para evitarlo.</p>

                    <br>
                    <br>

                    <strong><p class="text-center">7. Enlaces</p></strong>

                    <p>En el caso de que en www.unexpong.ve se dispusiesen enlaces o hipervínculos hacia otros sitios de Internet, la Universidad Nacional Experimental Politécnica "Antonio José de Sucre" no ejercerá ningún tipo de control sobre dichos sitios y contenidos. En ningún caso la Universidad Nacional Experimental Politécnica "Antonio José de Sucre" asumirá responsabilidad alguna por los contenidos de algún enlace perteneciente a un sitio web ajeno, ni garantizará la disponibilidad técnica, calidad, fiabilidad, exactitud, amplitud, veracidad, validez y constitucionalidad de cualquier material o información contenida en ninguno de dichos hipervínculos u otros sitios de Internet. Igualmente, la inclusión de estas conexiones externas no implicará ningún tipo de asociación, fusión o participación con las entidades conectadas.</p>

                    <br>
                    <br>

                    <strong><p class="text-center">8. Política de "Cookies"</p></strong>

                    <p>Una cookie es un archivo de información que el servidor de este sitio web envía al dispositivo (computador, teléfono, tableta, etc.) de quien accede a la página para almacenar y recuperar información sobre la navegación que se efectúa desde dicho equipo.</p>

                    <p>El portal web de la UNEXPO utiliza diversos tipos de cookies (técnicas, analíticas y sociales), tanto propias como de terceros  únicamente con la finalidad de mejorar la navegación del usuario en el sitio web y el acceso a los servicios web solicitados, sin ningún tipo de objeto publicitario o similar, para el análisis y elaboración de estadísticas de la navegación que el USUARIO realiza en el sitio web.</p>

                    <p>La aceptación de la presente política de "Cookies" implica que el usuario ha sido informado de una forma clara y completa sobre el uso de dispositivos de almacenamiento y recuperación de datos (cookies) así como que el Portal Web de la UNEXPO dispone del consentimiento del usuario para el uso de las mismas.</p>

                    <br>
                    <br>

                    <strong><p class="text-center">9. Derecho de exclusión</p></strong>

                    <p>La Universidad Nacional Experimental Politécnica "Antonio José de Sucre" se reserva el derecho a denegar o retirar el acceso al portal y/o los servicios ofrecidos sin necesidad de preaviso, a instancia propia o de un tercero, a aquellos usuarios que incumplan las condiciones generales de uso establecidas en el presente documento.</p>

                    <p>La Universidad Nacional Experimental Politécnica "Antonio José de Sucre" perseguirá el incumplimiento de las presentes condiciones así como cualquier utilización indebida de su portal ejerciendo todas las acciones civiles y penales que le puedan corresponder en derecho.</p>

                    <br>
                    <br>

                    <strong><p class="text-center">10. Modificación de las presentes condiciones y duración</p></strong>

                    <p>La Universidad Nacional Experimental Politécnica "Antonio José de Sucre" podrá modificar en cualquier momento las condiciones aquí determinadas, siendo debidamente publicadas como aquí aparecen. La vigencia de las citadas condiciones irá en función de su exposición y estarán vigentes hasta que sean modificadas por otras debidamente publicadas, debiendo el usuario acceder periódicamente a las mismas para estar al tanto de los cambios producidos.</p>

                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<footer>
    <nav class="navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo SERVIDOR ?>">
                    UNEXPO Núcleo Guarenas
                </a>
            </div>
            <div id="navbar" class="text-center">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo RUTA_AVISO_LEGAL ?>"><i class="fas fa-balance-scale"></i> Aviso Legal y Contacto</a></li>  
                </ul>
            </div>
        </div>
    </nav>
</footer>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>


