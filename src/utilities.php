<?php

function redirect($url): void {
    header("Location: $url");
    exit();
}