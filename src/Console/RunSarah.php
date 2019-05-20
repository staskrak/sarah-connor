<?php

namespace App\Console;

use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Cache\Simple\RedisCache;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunSarah extends Command
{
    protected static $defaultName = 'sarah:run';

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Start running');

        $this->filesystemCache($io);
        $this->redisCache($io);

        $io->success('Done!');
    }

    private function filesystemCache(SymfonyStyle $io): void
    {
        $cache = new FilesystemCache();

        if (!$cache->has('filesystem.john.connor')) {
            $cache->set('filesystem.john.connor', 'crazy little muppet');

            $io->section('...sleeping');
            \sleep(2);
        }
        $whoIsJohnConnor = $cache->get('filesystem.john.connor');

        if ($whoIsJohnConnor) {
            $io->success('Filesystem: John connor is ' . $whoIsJohnConnor);
        } else {
            $io->warning('Filesystem: John connor is ' . $whoIsJohnConnor);
        }     }

    private function redisCache(SymfonyStyle $io): void
    {
        $redis = RedisAdapter::createConnection(
            'redis://host.docker.internal:6379'
        );
        $cache = new RedisCache($redis);

        if (!$cache->has('redis.john.connor')) {
            $cache->set('redis.john.connor', 'crazy little muppet');

            $io->section('...sleeping');
            \sleep(2);
        }
        $whoIsJohnConnor = $cache->get('redis.john.connor');

        if ($whoIsJohnConnor) {
            $io->success('Redis: John connor is ' . $whoIsJohnConnor);
        } else {
            $io->warning('Redis: John connor is ' . $whoIsJohnConnor);
        }
    }
}
