<?php

namespace App\Traits;
use App\Model\CookieInterface;

trait CookieStoreTrait {
    public function addCookieNode(CookieInterface $cookie) {
        $this->addChild($cookie);
        return $this;
    }

    public function hasCookieNode(CookieInterface $cookie) {
        return $this->hasChild($cookie);
    }

    public function hasCookieName(string $cookieNodename) {
        return $this->hasChildKey($cookieNodename);
    }

    public function removeCookieNode(CookieInterface $cookie) {
        return $this->removeChild($cookie);
    }

    public function removeCookieName(string $cookieNodename) {
        return $this->removeChildKey($cookieNodename);
    }

    public function getCookieNode(string $cookieNodename) {
        return $this->getChild($cookieNodename);
    }

    public function setCookieNode(?string $cookieNodename, CookieInterface $cookie) {
        $this->setChild($cookieNodename, $cookie);
        return $this;
    }
}
