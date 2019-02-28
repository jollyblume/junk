<?php

namespace OldApp\Document;

/**
 * CookieInterface.
 *
 * Tags a class as being a Cookie Node.
 *
 * Cookies are Document Nodes created by a Source Node to store arbitrary data.
 *
 * The data is only manipulated and accessed by the Source Node that created it.
 *
 * The Cookie can implement any data needed to support the diverse storage needs
 * of another Node.
 */
interface CookieInterface extends ParentNodeInterface
{
}
