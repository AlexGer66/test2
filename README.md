# test2

## Overview

This repository contains a simple PHP/MySQL todo application that runs in Docker containers. It also includes phpMyAdmin for database inspection.

### Stack

- **MySQL 8.0** as the database server
- **phpMyAdmin** for web-based database management
- **PHP 8.1 Apache** web server hosting the todo app


## Getting started

Make sure you have Docker and Docker Compose installed on your machine.

1. **Start the environment**

```bash
# in the repo root
docker-compose up -d
```

This will launch three services:

| Service     | Port (host) | Description                         |
|-------------|-------------|-------------------------------------|
| `db`        | 3306        | MySQL server                        |
| `phpmyadmin`| 8080        | phpMyAdmin UI                       |
| `web`       | 8000        | Todo application (PHP/Apache)       |

2. **Create/inspect the database**

The `db` service automatically runs `db/init/init.sql` on first startup which creates a `todo` database and `tasks` table. You can connect using any MySQL client or through phpMyAdmin:

- Visit http://localhost:8080 and log in with:
  - Server: `db` (or `127.0.0.1` if using host network)
  - User: `root` / Password: `root`

3. **Open the application**

Browse to http://localhost:8000 to see the todo list. Add and delete tasks directly from the web interface.

### Useful commands (Docker)

```bash
# start all services in the background
cd /workspaces/test2
docker-compose up -d

# or start only the database or phpMyAdmin
docker-compose up -d db        # starts just MySQL
docker-compose up -d phpmyadmin

docker-compose down            # stop and remove containers

# view logs for a single service
docker-compose logs -f db

# run a shell inside the web container
docker-compose exec web bash

# connect to MySQL from the host (requires mysql client)
mysql -h127.0.0.1 -P3306 -uuser -ppassword todo
```

> **Note:** If port `8000` is already used on the host, edit `docker-compose.yml` and change the
> `web` service port mapping (`"8000:80"`) to a free port (e.g. `"8081:80"`).

---

### Manual (no Docker) ⚠️

If you prefer the classic LAMP‑style install, you can run everything locally just like on OpenServer.
Below are simple steps for Debian/Ubuntu systems. Adjust package names for other distros.

1. **Install packages**

```bash
sudo apt update
sudo apt install apache2 php php-mysql mysql-server phpmyadmin
```

- During phpMyAdmin installation choose `apache2` when prompted.

2. **Enable services**

```bash
sudo systemctl enable --now apache2
sudo systemctl enable --now mysql
```

3. **Create database** (from a root shell):

```sql
CREATE DATABASE todo;
USE todo;
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(255) NOT NULL
);
```

4. **Copy app files**

Put the contents of `src/` into your webroot (e.g. `/var/www/html/`). Alternatively run the
built‑in PHP server:

```bash
# from repo root:
./start-local.sh    # starts MySQL (if needed) and PHP dev server on port 8000
# stop with CTRL‑C, or run ./stop-local.sh to shut MySQL
```

5. **Access**

- Web app at http://localhost/ (or http://localhost:8000 if using built‑in server).
- phpMyAdmin at http://localhost/phpmyadmin (user `root` / password blank or `root`).

> You can adjust credentials and database name in `src/db.php` if you changed them.

The two helper scripts `start-local.sh` and `stop-local.sh` live in the repo root; make them
executable with `chmod +x start-local.sh stop-local.sh`.

---

Теперь у вас есть оба варианта: самодостаточное Docker‑окружение и привычная локальная установка.
Выбирайте тот, который более удобен для проверки и регистрации работы.👌

---

## Simple todo app logic

The PHP code lives in `src/`:

- `db.php` – PDO connection helper
- `index.php` – adds, lists and deletes tasks.

Tasks are stored in the `tasks` table created by the initialization script.

---

Feel free to modify and experiment. This minimal stack should help you verify connectivity and avoid issues with PHP/MySQL wiring in the future.

\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

старт!!!

docker-compose up -d

Остановить всё можно командой:

docker-compose down