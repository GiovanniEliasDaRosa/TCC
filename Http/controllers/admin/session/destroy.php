<?php

use Http\Forms\Authenticator;

(new Authenticator())->logout();

redirect('/login');
