<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>PHP Варіант 3 ("Усі завдання)</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 700px; margin: auto; padding: 20px; }
    h2 { color: #333366; }
    form { margin-bottom: 30px; }
    input, textarea { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 10px; }
    button { padding: 8px 12px; }
    hr { margin: 40px 0; }
    ul { padding-left: 20px; }
    .result { background: #f0f0f0; padding: 10px; border-left: 4px solid #3366cc; }
    .error { color: red; }
  </style>
</head>
<body>
  <h1>Варіант 3 – Усі завдання (PHP + XAMPP)</h1>

  <!-- ЗАДАЧА 1 -->
  <h2>1. Визначення дня тижня за введеною датою</h2>
  <form method="post">
    <label>Введіть дату (формат: 01.12.1990):</label>
    <input type="text" name="date_input" placeholder="01.12.1990">
    <button type="submit" name="day_btn">Показати день тижня</button>
  </form>
  <?php
  if (isset($_POST['day_btn'])) {
    $inputDate = trim($_POST['date_input']);
    $inputDate = str_replace(' ', '', $inputDate);
    $date = DateTime::createFromFormat('d.m.Y', $inputDate);

    if ($date && $date->format('d.m.Y') === $inputDate) {
      $days = ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'П’ятниця', 'Субота'];
      $dayOfWeek = $days[$date->format('w')];
      echo "<div class='result'><strong>День тижня:</strong> $dayOfWeek</div>";
    } else {
      echo "<div class='error'>❌ Невірний формат дати! Використовуйте формат дд.мм.рррр</div>";
    }
  }
  ?>

  <hr>

  <!-- ЗАДАЧА 2 -->
  <h2>2. Групування слів за першою літерою</h2>
  <form method="post">
    <label>Введіть слова через пробіл:</label>
    <textarea name="words_input" rows="4" placeholder="акула бджола авто барабан ..."></textarea>
    <button type="submit" name="group_btn">Групувати слова</button>
  </form>
  <?php
  if (isset($_POST['group_btn'])) {
    $text = mb_strtolower(trim($_POST['words_input']));
    $words = preg_split('/\s+/', $text);
    $grouped = [];

    foreach ($words as $word) {
      if ($word !== '') {
        $letter = mb_substr($word, 0, 1);
        $grouped[$letter][] = $word;
      }
    }

    if (!empty($grouped)) {
      ksort($grouped);
      foreach ($grouped as $letter => $wordList) {
        echo "<h4>Слова на букву '$letter'</h4><ul>";
        foreach ($wordList as $w) {
          echo "<li>$w</li>";
        }
        echo "</ul>";
      }
    } else {
      echo "<div class='error'>❌ Немає слів для обробки.</div>";
    }
  }
  ?>

  <hr>

  <!-- ЗАДАЧА 3 -->
  <h2>3. Обчислення факторіала</h2>
  <form method="post">
    <label>Введіть число (n ≥ 0):</label>
    <input type="number" name="fact_input" min="0" placeholder="Наприклад, 5">
    <button type="submit" name="fact_btn">Обчислити факторіал</button>
  </form>
  <?php
  if (isset($_POST['fact_btn'])) {
    $n = intval($_POST['fact_input']);
    if ($n < 0) {
      echo "<div class='error'>❌ Факторіал визначено лише для невід’ємних чисел.</div>";
    } else {
      $fact = 1;
      for ($i = 2; $i <= $n; $i++) $fact *= $i;
      echo "<div class='result'><strong>Факторіал $n:</strong> $fact</div>";
    }
  }
  ?>

</body>
</html>
