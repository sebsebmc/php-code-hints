<?php

/**
 * IDE stubs for the various default objects in Drupal 7.
 */
namespace Drupal7 {

  /**
   * Default node object in Drupal 7.
   *
   * @link https://drupal.org/node/49768
   */
  class Node {

    /**
     * The node's unique identifier.
     *
     * @var integer
     */
    public $nid;

    /**
     * The node's unique revision identifier of the current version.
     *
     * @var integer
     */
    public $vid;

    /**
     * The node's machine readable content type name.
     *
     * @var string
     */
    public $type;

    /**
     * The node's default language.
     *
     * @var string
     */
    public $language;

    /**
     * The node's title.
     *
     * @var string
     */
    public $title;

    /**
     * The node's unique user identifier who created it.
     *
     * @var integer
     */
    public $uid;

    /**
     * The node's status, one of <code>NODE_NO_PUBLISHED</code>, <code>NODE_PUBLISHED</code>.
     *
     * @var integer
     */
    public $status;

    /**
     * The node's creation timestamp.
     *
     * @var integer
     */
    public $created;

    /**
     * The node's changed timestamp.
     *
     * @var integer
     */
    public $changed;

    /**
     * Whether comments are allowed on this node, one of <code>COMMENT_NODE_HIDDEN</code>,
     * <code>COMMENT_NODE_CLOSED</code>, <code>COMMENT_NODE_OPEN</code>.
     *
     * @var integer
     */
    public $comment;

    /**
     * Whether this node is promoted to the frontpage or not, one of <code>NODE_NOT_PROMOTED</code>, <code>NODE_PROMOTED</code>.
     *
     * @var integer
     */
    public $promote;

    /**
     * Whether this node is sticky or not, one of <code>NODE_NOT_STICKY</code>, <code>NODE_STICKY</code>.
     *
     * @var integer
     */
    public $sticky;

    /**
     * The node's unique identifier of the translation source (or parent, if node is a translation).
     *
     * @var integer
     */
    public $tnid;

    /**
     * Whether the translation needs updating or not (<code>0</code> no update, <code>1</code> needs update).
     *
     * @var integer
     */
    public $translate;

    /**
     * The node's unique user identifier who created the current revision.
     *
     * @var integer
     */
    public $revision_uid;

    /**
     * The node's body content; long text field with summary.
     *
     * <b>NOTE</b><br>
     * Don't assume that this field will exist, as it is possible to remove it via Manage Fields on each content type.
     * Similarly, modules that define a custom node content type may not even attach a body in the first place.
     *
     * @var array
     */
    public $body;

    /**
     * Message left by the creator of this revision, explaining the changes.
     *
     * @var string
     */
    public $log;

    /**
     * The node's revision creation timestamp.
     *
     * @var integer
     */
    public $revision_timestamp;

    /**
     * The node's creator user name.
     *
     * @var string
     */
    public $name;

    /**
     * The node's creator user avatar.
     *
     * @var ?
     */
    public $picture;

    /**
     * The node's unique identifier of the last comment.
     *
     * @var integer
     */
    public $cid;

    /**
     * The node's timestamp of the last comment.
     *
     * @var integer
     */
    public $last_comment_timestamp;

    /**
     * The name of the user who last left a comment.
     *
     * @var string
     */
    public $last_comment_name;

    /**
     * The unique identifier of the user who last left a comment.
     *
     * @var integer
     */
    public $last_comment_uid;

    /**
     * The node's total comment count.
     *
     * @var integer
     */
    public $comment_count;

    /**
     * Serialized string of data associated with the node.
     *
     * @var string
     */
    public $data;

    /**
     * W3C standard to describe structured data.
     *
     * @link http://api.drupal.org/api/drupal/modules!rdf!rdf.module/group/rdf/7
     * @var string
     */
    public $rdf_mapping;

  }

  /**
   * Defines the file object as returned by e.g. {@see file_load()}.
   *
   * @since 7.0
   */
  class File {

    /**
     * The file's unique identifier.
     *
     * @var integer
     */
    public $fid;

    /**
     * The file's unique user identifier who uploaded the file.
     *
     * @var integer
     */
    public $uid;

    /**
     * The file's name (including the extension).
     *
     * @var string
     */
    public $filename;

    /**
     * The file's canonical absolute URI.
     *
     * @var string
     */
    public $uri;

    /**
     * The file's MIME type.
     *
     * @var string
     */
    public $filemime;

    /**
     * The file's size in Bytes.
     *
     * @var integer
     */
    public $filesize;

    /**
     * The file's status.
     *
     * @var integer
     */
    public $status;

    /**
     * The file's timestamp.
     *
     * @todo Is this the timestamp of creation or change?
     * @var integer
     */
    public $timestamp;

  }

  /**
   * Default term object in Drupal 7.
   */
  class Term {

    /**
     * The term's unique identifier.
     *
     * @var integer|string
     */
    public $tid;

    /**
     * The term's unique vocabulary identifier.
     *
     * @var integer|string
     */
    public $vid;

    /**
     * The term's human readable name.
     *
     * @var string
     */
    public $name;

    /**
     * The term's description.
     *
     * @var string
     */
    public $description;

    /**
     * The term's description text format.
     *
     * @var string
     */
    public $format;

    /**
     * The term's weight.
     *
     * @var integer|string
     */
    public $weight;

    /**
     * The term's depth.
     *
     * @var integer|null
     */
    public $depth;

    /**
     * The term's parents.
     *
     * @var array|null
     */
    public $parents;

    /**
     * The term's vocabulary machine name.
     *
     * @var string
     */
    public $vocabulary_machine_name;

  }

  /**
   * Default user object in Drupal 7.
   */
  class User {

    /**
     * The user's unique identifier.
     *
     * @var integer
     */
    public $uid;

    /**
     * The user's unique name.
     *
     * @var string
     */
    public $name;

    /**
     * The user's hashed password.
     *
     * @var string
     */
    public $pass;

    /**
     * The user's unique email address.
     *
     * @var string
     */
    public $mail;

    /**
     * The user's theme.
     *
     * @var null|string
     */
    public $theme;

    /**
     * The user's signature.
     *
     * @var null|string
     */
    public $signature;

    /**
     * The user's signature format.
     *
     * @var string
     */
    public $signature_format;

    /**
     * The user's creation timestamp.
     *
     * @var integer
     */
    public $created;

    /**
     * The user's last access timestamp.
     *
     * @var integer
     */
    public $access;

    /**
     * The user's last login timestamp.
     *
     * @var integer
     */
    public $login;

    /**
     * The user's status.
     *
     * <ul>
     *   <li><code>0</code> inactive</li>
     *   <li><code>1</code> active</li>
     * </ul>
     *
     * @var integer
     */
    public $status;

    /**
     * The user's time zone identifier.
     *
     * @var string
     */
    public $timezone;

    /**
     * The user's language;
     *
     * @var string
     */
    public $language;

    /**
     * The user's picture.
     *
     * @var \Drupal7\File
     */
    public $picture;

    /**
     * The user's registration email address.
     *
     * @var string
     */
    public $init;

    /**
     * The user's additional data.
     *
     * @var mixed
     */
    public $data;

    /**
     * The user's roles.
     *
     * @var array
     */
    public $roles;

  }

  /**
   * Default vocabulary object in Drupal 7.
   */
  class Vocabulary {

    /**
     * The vocabulary's unique identifier.
     *
     * @var integer
     */
    public $vid;

    /**
     * The vocabulary's human readable name.
     *
     * @var string
     */
    public $name;

    /**
     * The vocabulary's machine readable name.
     *
     * @var string
     */
    public $machine_name;

    /**
     * The vocabulary's description.
     *
     * @var string
     */
    public $description;

    /**
     * The vocabulary's hierarchy level.
     *
     * @var integer
     */
    public $hierarchy;

    /**
     * The vocabulary's module (if any).
     *
     * @var string
     */
    public $module;

    /**
     * The vocabulary's weight.
     *
     * @var integer
     */
    public $weight;

  }

}
