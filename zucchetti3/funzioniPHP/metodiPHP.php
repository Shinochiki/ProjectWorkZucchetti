<?php
session_start();
include("connection.php");

$subject = 0;

if (isset($_POST['subject']) && !empty($_POST['subject'])) {
    $subject = $_POST['subject'];

    if (isset($_POST['method'])) {
        $methodName = $_POST['method'];

        switch ($methodName) {
            case 'averageGrade':
                averageGrade($subject);
                break;
            case 'gradesUser':
                gradesUser($subject);
                break;
            default:
                echo "Invalid method name";
            break;
        }
    }
}

if ($_SESSION['userType'] == 0) {
    $user = "studente";
} else {
    $user = "professore";
}

function execueQuery($sql)
{
    include("connection.php");

    $UserData = $conn->query($sql);
    $x = $UserData->fetch_assoc();

    return $x;
}
function execueQueryTable($sql)
{
    include("connection.php");

    $UserData = $conn->query($sql);

    return $UserData;
}

function surnameUser()
{
    $local = $GLOBALS['user'];
    $ID = $_SESSION['logID'];

    $sql = "SELECT cognome FROM $local WHERE ID = $ID";

    $x = execueQuery($sql);

    return $x['cognome'];
}

function nameUser()
{
    $local = $GLOBALS['user'];
    $ID = $_SESSION['logID'];

    $sql = "SELECT nome FROM $local WHERE ID = $ID";

    $x = execueQuery($sql);

    return $x['nome'];
}

function classUser()
{
    $ID = $_SESSION['logID'];

    $sql = "SELECT classe.sezione, classe.anno FROM studente ";
    $sql .= "LEFT JOIN classe ON studente.classe_ID = classe.ID ";
    $sql .= "WHERE studente.ID = $ID";

    $x = execueQuery($sql);

    return $x;
}

function gradesUser($subject)
{
    $counter = 0;
    $finalGrade = '';
    $newGrade = 0;
    $newGradeINT = 0;
    $ID = $_SESSION['logID'];

    echo "<table class = 'tabellaVoti'>";

    if ($subject == 9) {
        $sql = "SELECT voto.voto, voto.tipologia, materia.materia FROM studente ";
        $sql .= "LEFT JOIN voto on studente.ID = voto.studente_ID ";
        $sql .= "LEFT JOIN materia on voto.materia_ID = materia.ID ";
        $sql .= "WHERE studente.ID = $ID";
    } else {
        $sql = "SELECT voto.voto, voto.tipologia, materia.materia FROM studente ";
        $sql .= "LEFT JOIN voto on studente.ID = voto.studente_ID ";
        $sql .= "LEFT JOIN materia on voto.materia_ID = materia.ID ";
        $sql .= "WHERE studente.ID = $ID AND materia.ID = $subject";
    }

    $local = execueQueryTable($sql);
    
    while ($grade = $local->fetch_assoc()) {
        if ($counter == 0) {
            if ($subject == 9) {
                echo "<tr>";
                echo "<td colspan='2'>" . "VOTI GENERALI" . "</td>";
                echo "</tr>";
            } else {
                echo "<tr>";
                echo "<td colspan='2'>" . "VOTI " . " " . strtoupper($grade['materia']);
                echo "</tr>";
            }
        }
        $newGrade = $grade['voto'] / 10;

        $newGradeINT = (int)$newGrade;
        $test = $newGrade - $newGradeINT;

        switch ($test * 10) {
            case 0:
                $finalGrade = (string)$newGradeINT;
                break;
            case 5:
                $finalGrade = (string)$newGradeINT . "½";
                break;
            default:
                if ($test * 10 < 5) {
                    $finalGrade = (string)$newGradeINT . "+";
                } else {
                    $finalGrade = (string)$newGradeINT + 1 . "-";
                }
                break;
        }
        echo "<tr>";
        echo "<td>" . $finalGrade . "</td>";
        echo "<td>" . $grade['materia'] . " " . $grade['tipologia'] . "</td>";
        echo "</tr>";
        $counter ++;
    }
    echo "</table>";
}


function averageGrade($subject)
{
    $newGrade = 0;
    $newGradeINT = 0;
    $counter = 0;
    $z = 0;

    $ID = $_SESSION['logID'];

    if ($subject == 9) {
        $sql = "SELECT voto.voto, voto.tipologia, materia.materia FROM studente ";
        $sql .= "LEFT JOIN voto on studente.ID = voto.studente_ID ";
        $sql .= "LEFT JOIN materia on voto.materia_ID = materia.ID ";
        $sql .= "WHERE studente.ID = $ID";
    } else {
        $sql = "SELECT voto.voto, voto.tipologia, materia.materia FROM studente ";
        $sql .= "LEFT JOIN voto on studente.ID = voto.studente_ID ";
        $sql .= "LEFT JOIN materia on voto.materia_ID = materia.ID ";
        $sql .= "WHERE studente.ID = $ID AND materia.ID = $subject";
    }

    $local = execueQueryTable($sql);

    while ($grade = $local->fetch_assoc()) {
        $newGrade = $grade['voto'] / 10;

        $newGradeINT = (int)$newGrade;
        $test = $newGrade - $newGradeINT;

        switch ($test * 10) {
            case 0:
                $z += $newGradeINT;
                break;
            case 5:
                $z += $newGradeINT;
                $z += 0.5;
                break;
            default:
                if ($test * 10 < 5) {
                    $z += $newGradeINT;
                    $z += 0.25;
                } else {
                    $z += $newGradeINT;
                    $z -= 0.25;
                }
                break;
        }
        $counter++;
    }
    $media = $z / $counter;
    echo round($media, 1);
}
