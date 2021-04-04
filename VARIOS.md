# VARIOS

## Referencias:

- https://www.laravelcode.com/post/laravel-8-crud-application-tutorial-with-example

## Acerca de la base de datos

A partir de **MariaDB 10.4** la gestión de usuarios y contraseñas se realiza a través de **mysql.global_priv** (y no con mysql.user).

- https://www.reddit.com/r/sysadmin/comments/avx1u6/how_to_change_the_root_password_with_mariadb_104/
- https://mariadb.com/kb/en/mysqlglobal_priv-table/
- https://runebook.dev/es/docs/mariadb/authentication-from-mariadb-104/index

Para poner contraseña a usuario root, hacemos:

```
sudo su
systemctl set-environment MYSQLD_OPTS="--skip-grant-tables"
systemctl restart mariadb
mariadb -u root

MariaDB [(none)]> select * from mysql.global_priv;
MariaDB [(none)]> select password('root');
MariaDB [(none)]> insert into mysql.global_priv values ('localhost', 'root', '{"access":0,"plugin":"mysql_native_password","authentication_string":"*81F5E21E35407D884A6CD4A731AEBFB6AF209E1B","account_locked":false,"password_last_changed":0}');
MariaDB [(none)]> insert into mysql.global_priv values ('%', 'root', '{"access":0,"plugin":"mysql_native_password","authentication_string":"*81F5E21E35407D884A6CD4A731AEBFB6AF209E1B","account_locked":false,"password_last_changed":0}');
MariaDB [(none)]> exit

systemctl unset-environment MYSQLD_OPTS
systemctl restart mariadb
mariadb -u root -proot
```

