<?php

require "module/form.phtml";

if (isset($_FILES['bashfile']) && isset($_POST['name'])) {

    // Vérification si c'est une image
    $image_info = getimagesize($_FILES["bashfile"]["tmp_name"]);

        // Vérification de la taille du fichier
        $max_file_size = 9 * 1024 * 1024; // 9 Mo
        if ($_FILES["bashfile"]["size"] <= $max_file_size) {

            // Dossier de destination
            $upload_dir = 'C:\Users\mxmto\Developpement\LocalHost\www\UploadEvaluationLinux\uploads/';
            // Nouveau nom de fichier pour éviter les collisions
            $upload_file = $upload_dir . $_POST['name'] . '_bash_history-' . uniqid() . '.log';

            // Déplacer le fichier téléchargé vers le dossier de destination
            if (move_uploaded_file($_FILES["bashfile"]["tmp_name"], $upload_file)) {

                resultPicture(1, "Votre Fichier à bien été envoyé.");


            } else {
                resultPicture(2, "Une erreur s'est produite lors du déplacement du fichier vers le dossier de destination.");
            }

        } else {
            resultPicture(2, "La taille du fichier dépasse la limite autorisée de 9 Mo.");
        }


}

function resultPicture($why, $msg)
{

    if ($why == 1) {

        header("location: ?true=" . $msg);

    }

    if ($why == 2) {

        header("location: ?err=" . $msg);
    }

}

if (!empty($_GET['true'])) {?>
    <script>
        if(Text != 1){
            iziToast.success({
                title: 'Succès',
                position: 'bottomRight',
                message: '<?php echo $_GET['true']; ?>'
            });
        }
    </script>
<?php } ?>

    <?php if (!empty($_GET['err'])) { ?>
    <script>
        if(Text != 1){
            iziToast.error({
                title: 'Erreur',
                position: 'bottomRight',
                message: ' <?php echo $_GET['err']; ?>'
            });
        }
    </script>
<?php } ?>