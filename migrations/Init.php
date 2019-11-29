<?php declare(strict_types=1);

require 'Migrate.php';

class Init extends Migrate
{
    public function up(): void
    {
        $this->execute('
            CREATE TABLE `post` (
              `id` int(11) NOT NULL,
              `title` varchar(255) NOT NULL,
              `body` text NOT NULL,
              `publish_date` datetime NOT NULL,
              `author_id` int(11) NOT NULL,
              `comment_ids` varchar(255) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ');
        $this->execute('
            ALTER TABLE `post`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `id` (`id`);
        ');
        $this->execute('
            ALTER TABLE `post`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ');
        $this->execute('
            CREATE TABLE `comment` (
              `id` int(11) NOT NULL,
              `body` text NOT NULL,
              `author` varchar(255) NOT NULL,
              `author_email` varchar(255) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ');
        $this->execute('
            ALTER TABLE `comment`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `id` (`id`);
        ');
        $this->execute('
            ALTER TABLE `comment`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ');
        $this->execute('
            CREATE TABLE `author` (
              `id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ');
        $this->execute('
            ALTER TABLE `author`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `id` (`id`);
        ');
        $this->execute('
            ALTER TABLE `author`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ');
    }

    public function down(): void
    {
        $this->execute('DROP TABLE `post`');
        $this->execute('DROP TABLE `comment`');
        $this->execute('DROP TABLE `author`');
    }
}

$init = new Init();
if($argv[1] === 'down'){
    $init->down();
} else {
    $init->up();
}
