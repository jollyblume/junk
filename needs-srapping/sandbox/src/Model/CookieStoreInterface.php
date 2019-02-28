<?php

namespace App\Model;

interface CookieStoreInterface extends ParentNodeInterface, ReferencableNodeInterface {
    public function addCookieNode(CookieInterface $cookie);

    public function hasCookieNode(CookieInterface $cookie);

    public function hasCookieName(string $cookieNodename);

    public function removeCookieNode(CookieInterface $cookie);

    public function removeCookieName(string $cookieNodename);

    public function getCookieNode(string $cookieNodename);

    public function setCookieNode(string $cookieNodename, CookieInterface $cookie);
}
