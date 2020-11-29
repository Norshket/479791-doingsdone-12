<?php
function count_task($arr, $projectname) {
  $count = 0;
  foreach($arr as $task) {
      if ($task['Category'] === $projectname) {
          $count++;
      }
  };
  return($count);
};
?>

<div class="content">
    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
            <ul class="main-navigation__list">
            <?php foreach ($projects as $num => $project): ?>
                <li class="main-navigation__list-item <?= ($num == 0) ? 'main-navigation__list-item--active':''?>">
                    <a class="main-navigation__list-item-link" href="#"><?= $project ?></a>
                    <span class="main-navigation__list-item-count"><?= count_task($tasks, $project)?></span>
                </li>
            <?php endforeach; ?>
            </ul>
        </nav>

        <a class="button button--transparent button--plus content__side-button"
            href="pages/form-project.html" target="project_add">Добавить проект</a>
    </section>

    <main class="content__main">
        <h2 class="content__main-heading">Список задач</h2>

        <form class="search-form" action="index.php" method="post" autocomplete="off">
            <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

            <input class="search-form__submit" type="submit" name="" value="Искать">
        </form>

        <div class="tasks-controls">
            <nav class="tasks-switch">
                <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                <a href="/" class="tasks-switch__item">Повестка дня</a>
                <a href="/" class="tasks-switch__item">Завтра</a>
                <a href="/" class="tasks-switch__item">Просроченные</a>
            </nav>

            <label class="checkbox">
                <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                <input class="checkbox__input visually-hidden show_completed" <?php if ($show_complete_tasks === 1): ?>checked<?php endif; ?> type="checkbox">
                <span class="checkbox__text">Показывать выполненные</span>
            </label>
        </div>

        <table class="tasks">
        <?php foreach ($tasks as $task):?>
            <?php if ($task['Done'] === true && $show_complete_tasks === 0) {continue;} ?>
            <tr class="tasks__item task <?= ($task['Done'] === true) ? 'task--completed':''?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden" type="checkbox">
                        <span class="checkbox__text"><?= htmlspecialchars($task['task']) ?></span>
                    </label>
                </td>

                <td class="task__date">
                    <?= htmlspecialchars($task['completion_date']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </main>
</div>