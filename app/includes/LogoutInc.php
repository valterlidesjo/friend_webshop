<?php

session_start();
session_reset();
session_destroy();

header("location: /dashboard/webbshop-uppgift/login?success=logoutsuccess");
