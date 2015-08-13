<?php
session_start();
if(!isset($_SESSION['finishTime'])){
    header("Location: quiz.php");
}

$totalTime = ($_SESSION['finishTime']-$_SESSION['startTime']);

$aQuestionPoint = 100 / $_SESSION['totalQuestionCount'];
$usersPoint = $aQuestionPoint * $_SESSION['correctAnswerCount'];
?>
<?php include('inc/header.php') ?>
    <div class="well text-center">
    <h1>Sonuç</h1>
    <ul class="list-group list-unstyled">
        <li>Toplam Soru: <strong><?=$_SESSION['totalQuestionCount'];?></strong></li>
        <li>Doğru Cevap: <strong><?=$_SESSION['correctAnswerCount'];?></strong></li>
        <li>Süre: <strong><?=$totalTime;?> sn</strong></li>
        <li>Puan: <strong><?=number_format($usersPoint, 1, ',', '.');?></strong></li>
    </ul>
    <a href="destroy.php" class="btn btn-primary">Testi Yeniden Başlat</a>
    </div>
<?php
/////test bittiğinde sonuçları dök
?>
<table class="table table-striped">
   <tr><th scope="row">S.N.</th><th scope="row">SİZİN CEVABINIZ</th><th scope="row">DOĞRU CEVAP</th><th scope="row">SONUÇ</th></tr>
    <?php
foreach($_SESSION["compareAnswers"] as $i=> $total)
{
    if($total["correctAnswer"]==$total["myAnswer"])
    {
      $point="YANLIŞ";
      $class="danger";
    }
    else
    {
        $point="DOĞRU";
        $class="warning";
    }
    ?>
    <tr class="<?=$class?>">
        <td ><?=$i+1?></td>
        <td><?=$total["correctAnswer"]?></td>
        <td><?=$total["myAnswer"]?></td>
        <td><kbd><?=$point?></kbd></td>
    </tr>
<?php

}
?>
    </table>
<?include('inc/footer.php'); ?>
