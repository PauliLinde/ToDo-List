# Todo List Application

## Description

This is a Todo list App made in PHP and the Symfony framework, and frontend built with Svelte/Tailwind. 
It allows users to quickly and easily see, add, delete, and update tasks.

## Installation

```bash
git clone https://github.com/PauliLinde/todo-list.git
cd todo-list
composer install
npm install
npm run build
```

## Database setup

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Usage

```bash
symfony server:start
```
Visit http://localhost:8000/svelte/actions in your browser to see this app built with Svelte,
and http://localhost:8000/actions to see it built with Twig.

## Testing

```bash
php bin/phpunit
```

