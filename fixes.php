<?php

unlink('LICENSE');

if (!is_dir('var')) mkdir('var');

chmod('var', 0777);

unlink(__FILE__);

exec('git init && git add . && git commit -m "Installed"');
