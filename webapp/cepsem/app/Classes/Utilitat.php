<?php
    namespace App\Classes;

use Illuminate\Database\QueryException;

class Utilitat{

        public static function handleErrorMessage(QueryException $queryException) {

            $errorMessage = "";

            if (!empty($queryException->errorInfo[1])) {

                switch ($queryException->errorInfo[1]) {
                    //MySQL server-side error codes
                    case 1005:
                        $errorMessage = "No s'ha pogut crear la taula (" . $queryException->errorInfo[2] . ")";
                        break;
                    case 1044:
                        $errorMessage = "Accés denegat a la BD, user/password incorrectes";
                        break;
                    case 1049:
                        $errorMessage = "Base de dades desconeguda";
                        break;
                    case 1050:
                        $errorMessage = "Taula ja existent";
                        break;
                    case 1051:
                        $errorMessage = "Taula desconeguda";
                        break;
                    case 1054:
                        $errorMessage = "Columna desconeguda";
                        break;
                    case 1062:
                        $errorMessage = "Aquest registre ja existeix";
                        break;
                    default:
                        $errorMessage = "Error " . $queryException->errorInfo[1] . ": " . $queryException->errorInfo[2];
                        break;
                }

            } else {

                switch ($queryException->getCode()) {
                    case 1044:
                        $errorMessage = "Accés denegat a la BD, user/password incorrectes";
                        break;
                    case 1049:
                        $errorMessage = "Base de dades desconeguda";
                        break;
                    case 2002:
                        $errorMessage = "No s'ha trobat el servidor servidor";
                        break;
                    default:
                        $errorMessage = "Error " . $queryException->getCode() . ": " . $queryException->getMessage();
                        break;
                }

            }

            return $errorMessage;

        }
    }
?>
