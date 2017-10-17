
create table `task`(
    `id` bigint(20) not null AUTO_INCREMENT,
    `alias` varchar(64),
    `shell` varchar(128) not null,
    `action` varchar(128) not null,
    `params` text,
    `code` int(11),
    `result` text,
    `error` text,
    `progress` int(11),
    `message` text,
    `timeout` int(11),
    `step` int(11),
    `pid` int(11),
    `created` datetime,
    `started` datetime,
    `stopped` datetime,
    primary key (`id`)
);

