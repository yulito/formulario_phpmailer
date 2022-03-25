<?php    
    //RECUERDA QUE... para que funcione, se debe activar el permiso de "acceso de aplicaciones menos seguras" en la cuenta de correo que tengamos, en la parte de seguridad.

    $email = $_POST['correo'];
    $subj = $_POST['asunto'];
    $content = $_POST['mensaje'];

    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    $mail-> isSMTP();
    /*
    Gmail: smtp.gmail.com 465 (SSL)/587 (TLS)
    Hotmail: smtp.live.com 465
    */
    $mail-> SMTPDebug   = 0;
    $mail-> Host        ="smtp.gmail.com"; //En este caso usaremos gmail
    $mail-> Port        ="587";
    $mail->SMTPSecure    ="tls";
    $mail->SMTPAuth     ="true";

    $mail->Username     ="mi_correo@gmail.com"; //Aquí va el servicio de correo que se usará como servidor, ejemplo mi_correo@gmail.com
    $mail->Password     ="miContr4senia";        //Aquí va la contraseña, ejemplo miContr4senia_de_mi_correo (por lo que debe haber otro metodo que permita ocultar la contraseña)
    $mail->setFrom($email, "Formulario_smtp_PHPmailer"); //Aquí va el remitente, se pondra el correo del cual se esta enviando el mensaje ($email) y una descripcion. El $email se verá siemrpe y cuando sea enviado desde otro servidor de correos; por lo que en este caso no se mostrara ya que es una pagina web.
    $mail->addAddress("mi_correo@gmail.com"); //Aquí va el servidor de mensajeria que esta ocupando el programa, por lo que aquí va mi_correo@gmail.com o el corero del servidor que tengamos.
    //En caso de querer que nuestro programa envie correos, debemos invertir el contenido de setFrom(?) con el de addAdress(?)
    $mail->Subject=$subj;                       //Estos son los asuntos.
    $mail->msgHTML('<div style="background-color:black; color:white; height:100%; width:100%;"><h2>Email: '.$email.'</h2>
                    <p style="margin: 20px;">'.$content.'</p></div>'); //Este sera para el diseño de como se mostrara el mensaje en el correo, por lo que incluimos el $content que contiene el textArea del formulario.

    if(!$mail->send()){
        echo 'lo sentimos...'.$mail->ErrorInfo ;
    }else{
        echo "enviado perfectamente";
    }


/* MANERA BASICA DE ENVIAR CORREO (Para rellenar, ver foto agregada a esta misma carpeta)
    
        include("Mailer/src/PHPMailer.php");
        
    try{
        

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->isSMTP();

        $mail-> SMTPDebug   = 0;
        $mail-> Host        = $this->_host;
        $mail-> Port        = $this->_port;
        $mail-> SMTPAuth    = $this->_SMTPAuth;
        $mail-> SMTPSecure  = $this->_SMTPSecure;
        $mail-> SMTPOptions = array(
            'ssl'=>array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail-> Username = $this->_Username;
        $mail-> Password = $this->_Password;
        $mail-> setFrom($this->_Username, $this->_nameEmail);
        if(is_array($emailTo)){
            foreach($emailTo as $key => $value){
                $email->addAddress($value);
            }
        }else{
            $email->addAddress($emailTo);
        }
        //Asunto
        $mail->isHTML(true);
        $mail->Subject = $subject;
        //Cuerpo

    }catch(Exception $e){

    }
    */    
?>
