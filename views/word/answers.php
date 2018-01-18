<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

if (isset($this->params['results'])) {

    $base_word = $this->params['results']['word'];
    $this->title = 'Слова, которые можно составить из "' . $base_word . '"';

    if ($this->params['results']['status'] == 'success' && isset($this->params['results']['data']) && count($this->params['results']['data'])) {
        ?>
        <h3>Все слова, которые можно составить из "<?= $base_word ?>"</h3>

        <?php
        $total_lenght = [];
        $total_words = 0;
        foreach ($this->params['results']['data'] as $lenght => $words) {
            if (count($words) > 0) {
                $total_lenght[] = $lenght;
                $total_words += count($words);
            }
        }
        ?>
        <p><i>Из "<?= $base_word ?>" можно составить <?= $total_words ?> слов из <?= implode(',', $total_lenght) ?> букв</i>.</p>

        <?php
        $data = $this->params['results']['data'];
        ksort($data);
        reset($data);
        foreach ($data as $lenght => $words) {
            if (count($words) > 0) {
                ?>
                <p>Слова из <?= $lenght ?> букв, составленные из комбинации "<?= $base_word ?>"
                    (<?= count($words) ?> <?= count($words) > 1 ? 'слова' : 'слово' ?>):</p>
                <ul class="list-inline">
                    <?php
                    foreach ($words as $word) {
                        ?>
                        <li><a href="/description?word=<?= $word['vocab'] ?>"><?= $word['vocab'] ?></a> </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
        }
    } else {

        $this->title = 'Возможные комбинации слов не найдены';
        $this->params['breadcrumbs'][] = ['label' => 'Поиск слов', 'url' => ['/']];
        $this->params['breadcrumbs'][] = ['label' => 'Ничего не найдено'];
        ?>
        <div class="alert alert-warning">
            <strong>Ошибка!</strong> Ничего не найдено.
        </div>
        <p class="text-center">
            <a href="/" class="btn btn-success btn-lg">Попробовать снова</a>
        </p>
        <?php
    }
} else {
    $this->title = 'Возможные комбинации слов не найдены';
    $this->params['breadcrumbs'][] = ['label' => 'Поиск слов', 'url' => ['/']];
    $this->params['breadcrumbs'][] = ['label' => 'Ничего не найдено'];
    ?>
    <div class="alert alert-warning">
        <strong>Ошибка!</strong> Ничего не найдено.
    </div>
    <p class="text-center">
        <a href="/" class="btn btn-success btn-lg">Попробовать снова</a>
    </p>
    <?php
}
?>

