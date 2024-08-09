# Тестовый проект

Автор: Давыдов Артём
Время выполнения ~20 часов.

## Инструкция по запуску в Docker

1. Build: `docker compose build --no-cache`
2. Run: `docker compose up --pull always -d --wait`
3. Open `https://localhost`
   and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
4. Stop: `docker compose down --remove-orphans`

## Описание

Пройти тест (https://localhost/).
Можно проходить сколько угодно раз.
Результаты сохраняются в БД.
Результат содержит два списка: вопросы, на которые пользователь ответил правильно и неправильно.
Вопросы попадают в БД при запуске контейнера.

### Стек

Symfony, PSQL, Javascript (jquery, axios)

### Phpunit

калькуляция, определение правильности/неправильности ответа, преобразование форматов.

