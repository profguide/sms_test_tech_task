# Тестовый проект

Исполнитель: [Давыдов Артём](https://hh.ru/resume/1f3a6edbff03b7e1ac0039ed1f676c66373078)

Telegram: [@wolfandman](https://t.me/wolfandman)

Время выполнения ~20 часов.

## Инструкция по запуску в Docker

1. Build: `docker compose build --no-cache`
2. Run: `docker compose up --pull always -d --wait`
3. Open `https://localhost`
   and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
4. Stop: `docker compose down --remove-orphans`

## Описание и соответствие ТЗ

1. Можно проходить сколько угодно раз.
2. Результаты сохраняются в БД.
3. Результат содержит два списка: вопросы, на которые пользователь ответил правильно и неправильно.
4. Вопросы попадают в БД при запуске контейнера.

### Стек

PHP 8.2, Symfony 7.1, PSQL, Javascript (jquery, axios)

### Phpunit

1. Калькуляция
2. Определение правильности/неправильности ответа
3. Преобразование форматов для сохранения в БД.

