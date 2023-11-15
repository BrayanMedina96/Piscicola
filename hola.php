<html>

<body>

    <!DOCTYPE html>
    <html>

    <head>

    <body>

        <?php
        $mensaje = '';
        $mensaje .= "<figure>
        <center>
            <img src=' data:image/png;base64,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' alt='Red dot' width='100px'>
        </center>
       </figure>";
       $mensaje .= "El Lago <strong>Granja experimental CORHUILA</strong> ; esta presetando variaciones en los rangos permisibles. <br> Los valores actuales de las variables fisicoquímicas son los siguientes :";
       $mensaje .= "<br> <table style='width: 100%; border-collapse: collapse;border: 1px solid black;' class='table h5'>";
       $mensaje .= "<tr style='background-color:#efebea;'> <td style='border: 1px solid black;font-size:18px;font-weight:bold;color:#fb932c;'>Variable</td>  <td style='border: 1px solid black;font-size:18px;font-weight:bold;color:#fb932c;'>Valor</td> </tr>";
       $mensaje .= "<tr> <td style='border: 1px solid black;color: #210049;'>T.Amb</td>  <td style='border: 1px solid black;color: #210049;'>23 </td> </tr>";
       $mensaje .= "<tr style='background-color:#efebea;'> <td style='border: 1px solid black;color: #210049;'>T.Est</td>  <td style='border: 1px solid black;color: #210049;'>25</td> </tr>";
       $mensaje .= "<tr> <td style='border: 1px solid black;color: #210049;'>O.D</td>  <td style='border: 1px solid black;color: #210049;'>1</td> </tr>";
       $mensaje .= "<tr style='background-color:#efebea;'> <td style='border: 1px solid black;color: #210049;'>pH</td>  <td style='border: 1px solid black;color: #210049;'>7.4</td> </tr>";
       $mensaje .= "</table>";
        echo $mensaje;
        ?>



        <table style="max-width:600px;border-width:1px;border-style:solid;border-color:#dcdcdc" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                <tr>
                    <td style="text-align:center">
                        <figure>
                            <center>
                                <img width="100px" src=" data:image/png;base64,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" alt="Red dot">
                            </center>
                        </figure>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:0px;padding-bottom:0px;padding-right:5%;padding-left:5%">
                        <table style="max-width:550px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:15px;color:#210049;text-align:center" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>
                                <tr>
                                    <td style="font-size:18px;font-weight:bold;color:#fb932c;padding-top:30px;padding-bottom:20px;padding-right:0%;padding-left:0%;text-align:center" width="100%">Bienvenido</td>
                                </tr>
                                <tr>
                                    <td style="padding-top:0px;padding-bottom:15px;padding-right:0px;padding-left:0px;text-align:left" width="100%">
                                        <p>
                                            <span style="font-size:16px">
                                                <strong>¡Ya está listo tu usurio en Aqua!</strong>
                                                <img goomoji="1f609" data-goomoji="1f609" style="margin:0 0.2ex;vertical-align:middle;max-height:24px" alt="😉" src="https://mail.google.com/mail/e/1f44c" data-image-whitelisted="" class="CToWUd">
                                            </span>
                                        </p>
                                        <ol>
                                            <li>
                                                <strong>
                                                    <span style="font-size:16px">Usuario:</span>
                                                </strong>
                                                <span style="font-size:16px">
                                                    @USUARIO
                                                </span>
                                            </li>
                                            <li>
                                                <strong>
                                                    <span style="font-size:16px">Contraseña:</span>
                                                </strong>
                                                <span style="font-size:16px">
                                                    @CONTRASEÑA
                                                </span>
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:30px;padding-bottom:35px;padding-right:0%;padding-left:0%">
                                        <table style="max-width:300px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;color:#fb932c;text-align:center;background-color:#fb932c;background-image:none;background-repeat:repeat;background-position:top left;border-width:1px;border-style:solid;border-color:#fb932c;border-radius:5px" width="100%" align="center">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:18px;font-weight:bold;padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;color:white;line-height:20px;text-decoration:none" width="100%">
                                                        <a href="http://3.129.150.14/aqua/web/view/login.php" style="color:white;text-decoration:none" target="_blank">
                                                            Completar la inscripción
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="max-width:570px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;border-top-width:1px;border-top-style:dotted;border-top-color:#dcdcdc;text-align:center;padding-top:20px;padding-bottom:20px;padding-right:0px;padding-left:0px" width="100%" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>


    </body>

    </html>





    <!--
    <div marginheight=0 marginwidth=0
        style=background:#fafafa;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important
        bgcolor=#fafafa>

        <table
            style=background:#fafafa;border-collapse:collapse;border-spacing:0;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;height:100%;line-height:19px;margin:0;padding:10px;text-align:left;vertical-align:top;width:100%
            bgcolor=#fafafa>
            <tbody>
                <tr style=padding:0;text-align:left;vertical-align:top align=left>
                    <td style=border-collapse:collapse!important;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word
                        valign=top align=center>
                        <center style=min-width:580px;width:100%>

                            <table style=border-collapse:collapse;border-spacing:0;margin:0
                                auto;padding:0;text-align:inherit;vertical-align:top;width:580px>
                                <tbody>
                                    <tr style=padding:0;text-align:left;vertical-align:top align=left>
                                        <td style=border-collapse:collapse!important;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word
                                            valign=top align=left>

                                            <table
                                                style=border-collapse:collapse;border-spacing:0;margin-top:20px;padding:0;text-align:left;vertical-align:top;width:100%>
                                                <tbody>
                                                    <tr style=padding:0;text-align:left;vertical-align:top align=left>
                                                        <td style=border-collapse:collapse!important;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word
                                                            valign=top align=center>
                                                            <center style=min-width:580px;width:100%>
                                                                <div style=margin-bottom:30px;margin-top:20px;text-align:center!important
                                                                    align=center !important>
                                                                      <h1 style=color:#586069;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                        UI',Helvetica,Arial,sans-serif,'Apple
                                                                                        Color Emoji','Segoe UI
                                                                                        Emoji','Segoe UI
                                                                                        Symbol';font-size:20px;font-weight:400!important;line-height:1.25;margin:0
                                                                                        0
                                                                                        30px;padding:0;text-align:left;word-break:normal
                                                                                        > Aqua log</h1>
                                                                </div>
                                                            </center>
                                                        </td>
                                                        <td style=border-collapse:collapse!important;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:0px;word-break:break-word
                                                            valign=top align=left></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table
                                                style=background:#ffffff;border-collapse:collapse;border-radius:3px!important;border-spacing:0;border:1px
                                                solid #dddddd;padding:0;text-align:left;vertical-align:top
                                                bgcolor=#ffffff>
                                                <tbody>
                                                    <tr style=padding:0;text-align:left;vertical-align:top align=left>
                                                        <td style=border-collapse:collapse!important;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word
                                                            valign=top align=left>

                                                            <div
                                                                style=color:#333333;font-size:14px;font-weight:normal;line-height:20px;margin:20px>
                                                                <table
                                                                    style=background:#fff;border-collapse:separate!important;border-spacing:0;box-sizing:border-box;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;height:100%;line-height:19px;margin:0;padding:10px;text-align:left;vertical-align:top;width:100%
                                                                    width=100% bgcolor=#fff>
                                                                    <tbody>
                                                                        <tr style=padding:0;text-align:left;vertical-align:top
                                                                            align=left>
                                                                            <td style=border-collapse:collapse!important;box-sizing:border-box;color:#222222;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                UI',Helvetica,Arial,sans-serif,'Apple
                                                                                Color Emoji','Segoe UI Emoji','Segoe UI
                                                                                Symbol';font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word
                                                                                valign=top align=left></td>
                                                                            <td style=border-collapse:collapse!important;box-sizing:border-box;color:#222222;display:block;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                UI',Helvetica,Arial,sans-serif,'Apple
                                                                                Color Emoji','Segoe UI Emoji','Segoe UI
                                                                                Symbol';font-size:14px;font-weight:normal;line-height:19px;margin:0
                                                                                auto;max-width:580px;padding:24px;text-align:left;vertical-align:top;width:580px;word-break:break-word
                                                                                width=580 valign=top align=left>
                                                                                <div style=box-sizing:border-box;display:block;margin:0
                                                                                    auto;max-width:580px>


                                                                                    <h1 style=color:#586069;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                        UI',Helvetica,Arial,sans-serif,'Apple
                                                                                        Color Emoji','Segoe UI
                                                                                        Emoji','Segoe UI
                                                                                        Symbol';font-size:20px;font-weight:400!important;line-height:1.25;margin:0
                                                                                        0
                                                                                        30px;padding:0;text-align:left;word-break:normal
                                                                                        align=left>
                                                                                        Hola, <strong
                                                                                            style=color:#24292e!important>@BrayanMedina96</strong>!
                                                                                        Para completar su registro en
                                                                                        <span class=il>GitHub</span>
                                                                                        Solo necesitamos verificar su
                                                                                        dirección <strong
                                                                                            style=color:#24292e!important><a
                                                                                                href=mailto:bh-medinac@corhuila.edu.co
                                                                                                target=_blank>bh-medinac@corhuila.edu.co</a></strong>.
                                                                                    </h1>

                                                                                    <table
                                                                                        style=border-collapse:separate!important;border-spacing:0;box-sizing:border-box;margin:0
                                                                                        0
                                                                                        30px;padding:0;text-align:left;vertical-align:top;width:100%
                                                                                        width=100% cellspacing=0
                                                                                        cellpadding=0>
                                                                                        <tbody>
                                                                                            <tr style=padding:0;text-align:left;vertical-align:top
                                                                                                align=left>
                                                                                                <td style=border-collapse:collapse!important;box-sizing:border-box;color:#222222;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                                    UI',Helvetica,Arial,sans-serif,'Apple
                                                                                                    Color Emoji','Segoe
                                                                                                    UI Emoji','Segoe UI
                                                                                                    Symbol';font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word
                                                                                                    valign=top align=>
                                                                                                    <table
                                                                                                        style=border-collapse:separate!important;border-spacing:0;box-sizing:border-box;padding:0;text-align:left;vertical-align:top;width:auto
                                                                                                        cellspacing=0
                                                                                                        cellpadding=0>
                                                                                                        <tbody>
                                                                                                            <tr style=padding:0;text-align:left;vertical-align:top
                                                                                                                align=left>
                                                                                                                <td style=background:#0366d6;border-collapse:collapse!important;border-radius:5px;box-sizing:border-box;color:#222222;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                                                    UI',Helvetica,Arial,sans-serif,'Apple
                                                                                                                    Color
                                                                                                                    Emoji','Segoe
                                                                                                                    UI
                                                                                                                    Emoji','Segoe
                                                                                                                    UI
                                                                                                                    Symbol';font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word
                                                                                                                    valign=top
                                                                                                                    bgcolor=#0366d6
                                                                                                                    align=center>
                                                                                                                    <a style=background:#0366d6;border-radius:5px;border:1px
                                                                                                                        solid
                                                                                                                        #0366d6;box-sizing:border-box;color:#ffffff;display:inline-block;font-size:14px;font-weight:bold;margin:0;padding:10px
                                                                                                                        20px;text-decoration:none
                                                                                                                        href=https://github.com/users/BrayanMedina96/emails/85757638/confirm_verification/361dbedfecd1afb6bb150e61a2956d099dab6678?utm_campaign=github-email-verification&amp;utm_content=html&amp;utm_medium=email&amp;utm_source=verification-email
                                                                                                                        target=_blank
                                                                                                                        data-saferedirecturl=https://www.google.com/url?q=https://github.com/users/BrayanMedina96/emails/85757638/confirm_verification/361dbedfecd1afb6bb150e61a2956d099dab6678?utm_campaign%3Dgithub-email-verification%26utm_content%3Dhtml%26utm_medium%3Demail%26utm_source%3Dverification-email&amp;source=gmail&amp;ust=1575558746665000&amp;usg=AFQjCNFm3440yK8FmQXPlkJPsF93Gt9wsg>Verify
                                                                                                                        email
                                                                                                                        address</a>
                                                                                                                        </td>
                                                                                                                        </tr>
                                                                                                                        </tbody>
                                                                                                                        </table>
                                                                                                                        </td>
                                                                                                                        </tr>
                                                                                                                        </tbody>
                                                                                                                        </table>
                                                                                                                        <p
                                                                                                                        style=color:#222222;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                                                        UI',Helvetica,Arial,sans-serif,'Apple
                                                                                                                        Color
                                                                                                                        Emoji','Segoe
                                                                                                                        UI
                                                                                                                        Emoji','Segoe
                                                                                                                        UI
                                                                                                                        Symbol';font-size:14px;font-weight:normal;line-height:1.5;margin:0
                                                                                                                        0
                                                                                                                        15px;padding:0;text-align:left
                                                                                                                        align=left>
                                                                                                                        Once
                                                                                                                        verified,
                                                                                                                        you
                                                                                                                        can
                                                                                                                        start
                                                                                                                        using
                                                                                                                        all
                                                                                                                        of
                                                                                                                        <span
                                                                                                                            class=il>GitHub</span>'s
                                                                                                                        features
                                                                                                                        to
                                                                                                                        explore,
                                                                                                                        build,
                                                                                                                        and
                                                                                                                        share
                                                                                                                        projects.
                                                                                                                        </p>

                                                                                                                        <p style=color:#586069!important;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                                                            UI',Helvetica,Arial,sans-serif,'Apple
                                                                                                                            Color
                                                                                                                            Emoji','Segoe
                                                                                                                            UI
                                                                                                                            Emoji','Segoe
                                                                                                                            UI
                                                                                                                            Symbol';font-size:12px!important;font-weight:normal;line-height:1.5;margin:0
                                                                                                                            0
                                                                                                                            15px;padding:0;text-align:left
                                                                                                                            align=left>
                                                                                                                            Button
                                                                                                                            not
                                                                                                                            working?
                                                                                                                            Paste
                                                                                                                            the
                                                                                                                            following
                                                                                                                            link
                                                                                                                            into
                                                                                                                            your
                                                                                                                            browser:
                                                                                                                            <a style=box-sizing:border-box;color:#0366d6;text-decoration:none;word-break:break-all
                                                                                                                                href=https://github.com/users/BrayanMedina96/emails/85757638/confirm_verification/361dbedfecd1afb6bb150e61a2956d099dab6678?utm_campaign=github-email-verification&amp;utm_content=html&amp;utm_medium=email&amp;utm_source=verification-email
                                                                                                                                target=_blank
                                                                                                                                data-saferedirecturl=https://www.google.com/url?q=https://github.com/users/BrayanMedina96/emails/85757638/confirm_verification/361dbedfecd1afb6bb150e61a2956d099dab6678?utm_campaign%3Dgithub-email-verification%26utm_content%3Dhtml%26utm_medium%3Demail%26utm_source%3Dverification-email&amp;source=gmail&amp;ust=1575558746665000&amp;usg=AFQjCNFm3440yK8FmQXPlkJPsF93Gt9wsg>https://
                                                                                                                                <span
                                                                                                                                class=il>github</span>.com/users/<wbr>BrayanMedina96/emails/<wbr>85757638/confirm_verification/<wbr>361dbedfecd1afb6bb150e61a2956d<wbr>099dab6678</a>
                                                                                                                        </p>

                                                                                                                        <p style=color:#586069!important;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                                                            UI',Helvetica,Arial,sans-serif,'Apple
                                                                                                                            Color
                                                                                                                            Emoji','Segoe
                                                                                                                            UI
                                                                                                                            Emoji','Segoe
                                                                                                                            UI
                                                                                                                            Symbol';font-size:12px!important;font-weight:normal;line-height:1.5;margin:0
                                                                                                                            0
                                                                                                                            15px;padding:0;text-align:left
                                                                                                                            align=left>
                                                                                                                            You’re
                                                                                                                            receiving
                                                                                                                            this
                                                                                                                            email
                                                                                                                            because
                                                                                                                            you
                                                                                                                            recently
                                                                                                                            created
                                                                                                                            a
                                                                                                                            new
                                                                                                                            <span
                                                                                                                                class=il>GitHub</span>
                                                                                                                            account
                                                                                                                            or
                                                                                                                            added
                                                                                                                            a
                                                                                                                            new
                                                                                                                            email
                                                                                                                            address.
                                                                                                                            If
                                                                                                                            this
                                                                                                                            wasn’t
                                                                                                                            you,
                                                                                                                            please
                                                                                                                            ignore
                                                                                                                            this
                                                                                                                            email.
                                                                                                                        </p>


                                                                                                                        <div
                                                                                                                            style=box-sizing:border-box;clear:both;width:100%>
                                                                                                                            <hr style=background:#d9d9d9;border-style:solid
                                                                                                                                none
                                                                                                                                none;border-top-color:#e1e4e8;border-width:1px
                                                                                                                                0
                                                                                                                                0;color:#959da5;font-size:12px;height:0;line-height:18px;margin:24px
                                                                                                                                0
                                                                                                                                30px;overflow:visible>
                                                                                                                            <div
                                                                                                                                style=box-sizing:border-box;color:#959da5;font-size:12px;line-height:18px>
                                                                                                                                <p style=color:#959da5;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                                                                    UI',Helvetica,Arial,sans-serif,'Apple
                                                                                                                                    Color
                                                                                                                                    Emoji','Segoe
                                                                                                                                    UI
                                                                                                                                    Emoji','Segoe
                                                                                                                                    UI
                                                                                                                                    Symbol';font-size:12px;font-weight:normal;line-height:18px;margin:0
                                                                                                                                    0
                                                                                                                                    15px;padding:0;text-align:center
                                                                                                                                    align=center>
                                                                                                                                    <a href=https://github.com/settings/emails*%7CUPR_UTM%7C*
                                                                                                                                        style=box-sizing:border-box;color:#959da5;font-size:12px;line-height:18px;text-decoration:none
                                                                                                                                        target=_blank
                                                                                                                                        data-saferedirecturl=https://www.google.com/url?q=https://github.com/settings/emails*%257CUPR_UTM%257C*&amp;source=gmail&amp;ust=1575558746665000&amp;usg=AFQjCNH1Rnw7lJAMCex4C32sz0Ga8BPeRA>Email
                                                                                                                                        preferences</a>
                                                                                                                                        ·
                                                                                                                                        <a
                                                                                                                                        style=box-sizing:border-box;color:#959da5;font-size:12px;line-height:18px;text-decoration:none>Terms</a>
                                                                                                                                    ·
                                                                                                                                    <a
                                                                                                                                        style=box-sizing:border-box;color:#959da5;font-size:12px;line-height:18px;text-decoration:none>Privacy</a>
                                                                                                                                    ·
                                                                                                                                    <a href=https://github.com/login*%7CUPR_UTM%7C*
                                                                                                                                        style=box-sizing:border-box;color:#959da5;font-size:12px;line-height:18px;text-decoration:none
                                                                                                                                        target=_blank
                                                                                                                                        data-saferedirecturl=https://www.google.com/url?q=https://github.com/login*%257CUPR_UTM%257C*&amp;source=gmail&amp;ust=1575558746665000&amp;usg=AFQjCNETXQbxRo6PZqaN980UrACWwOsq9Q>Sign
                                                                                                                                        into
                                                                                                                                        <span
                                                                                                                                        class=il>GitHub</span></a>
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                </div>

                                                                            </td>
                                                                            <td style=border-collapse:collapse!important;box-sizing:border-box;color:#222222;font-family:-apple-system,BlinkMacSystemFont,'Segoe
                                                                                UI',Helvetica,Arial,sans-serif,'Apple
                                                                                Color Emoji','Segoe UI Emoji','Segoe UI
                                                                                Symbol';font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word
                                                                                valign=top align=left></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>





                                                            </div>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table
                                                style=border-collapse:collapse;border-spacing:0;margin-bottom:30px;padding:0;text-align:left;vertical-align:top;width:100%>
                                                <tbody>
                                                    <tr style=padding:0;text-align:left;vertical-align:top align=left>
                                                        <td style=border-collapse:collapse!important;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word
                                                            valign=top align=center>
                                                            <center style=min-width:580px;width:100%>
                                                                <div style=margin-bottom:25px;margin-top:25px;text-align:center!important
                                                                    align=center !important>
                                                                    <img src=https://ci3.googleusercontent.com/proxy/UFMFbT0UrmdnumWhFvGkEviupuQf7QIzl3VYfzne8CB_LgHu7d0dAbUn5An4x3f8ySn_6KomW968hn2Z6wR3gk3e3r0L-r8TYF530A4AASxTI0c=s0-d-e1-ft#https://github.githubassets.com/images/email/global/wordmark.png
                                                                        style=clear:both;display:block;float:none;height:28px;margin:0
                                                                        auto;max-height:28px;max-width:102px;outline:none;text-decoration:none;width:102px
                                                                        class=CToWUd width=102 height=28 align=none>
                                                                </div>
                                                                <p style=color:#888888;font-family:'Helvetica','Arial',sans-serif;font-size:12px;font-weight:normal;line-height:1.5;margin:0
                                                                    0 10px;padding:0;text-align:center align=center>
                                                                    Sent with &lt;3 by <strong><span
                                                                            class=il>GitHub</span></strong>.<br>
                                                                    <span class=il>GitHub</span>, Inc. 88 Colin P Kelly
                                                                    Jr Street<br>San Francisco, CA 94107
                                                                </p>
                                                            </center>
                                                        </td>
                                                        <td style=border-collapse:collapse!important;color:#222222;font-family:'Helvetica','Arial',sans-serif;font-size:14px;font-weight:normal;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:0px;word-break:break-word
                                                            valign=top align=left></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </center>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class=yj6qo></div>
        <div class=adL>

        </div>
    </div>


</body>

</html>
-->


    <?php




    /*
$to = "bh-medinac@corhuila.edu.co";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);
*/

    listarArchivos("C:\laragon\www\Scrum\svg");

    function listarArchivos($path)
    {
        $dir = opendir($path);
        $files = array();
        while ($elemento = readdir($dir)) {
            if ($elemento != "." && $elemento != "..") {

                if (is_dir($path . $elemento)) {
                    listarArchivos($path . $elemento . '/');
                } else {
                    $files[] = $elemento;
                }
            }
        }
        echo $path;

        for ($x = 0; $x < count($files); $x++) {
            echo  $files[$x] . "=> <img width=100 height=100 src=http://localhost:8000/Scrum/svg/" . $files[$x] . ">";
        }
        echo "<BR>";
    }

    listarArchivos('./');

    ?>