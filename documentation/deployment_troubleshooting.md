
## Возможные проблемы при деплое проекта

При деплое на сервер (или локальном деплое), возможны следующие ошибки и пути их решения

- Роут /admin/login не найден:

Команда ниже публикует конфигурационные файлы Filament, создает необходимые маршруты и контроллеры, настраивает базовые компоненты и стили для административной панели.
```bash
php artisan filament:install --panels
```
В случае изменений в файле AdminPanelProvider.php, необходимо откатить их
```bash
git checkout app/Providers/Filament/AdminPanelProvider.php
```

- При входе в административную панель возникает 405 ошибка:
```bash
php artisan vendor:publish --force --tag=livewire:assets
```
