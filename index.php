<?php

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'formUpdateComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
                formUpdateCommand($_GET['id'], $_GET['idComment']);
            } else {
                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
            }
        } elseif ($_GET['action'] == 'updateComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
                if (!empty($_POST['comment'])) {
                    updateCommand($_GET['id'], $_GET['idComment'], $_POST['comment']);
                } else {
                    throw new Exception('Erreur : tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
            }
        } elseif ($_GET['action'] == 'addComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Erreur : tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
            }
        } else {

            listPosts();
        }
    } else {
        listPosts();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}
