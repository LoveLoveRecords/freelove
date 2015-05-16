<?php
/**
 * Created by PhpStorm.
 * User: keef
 * Date: 4/23/15
 * Time: 1:43 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Release
 * @ORM\Entity
 * @ORM\Table(name="releases")
 */

class Release
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $serial;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $artist;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $length;
    /**
     * @ORM\Column(type="string", length=255)  #Comma delimited list of genres
     */
    protected $genre; # Array
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $description;
    /**
     * @ORM\Column(type="string", length=255) #Comma delimited list of track, length
     */
    protected $tracks; # Key/Pair Array $trackName => $length
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $download;
    /**
     * @ORM\Column(type="string", length=255) #Link to thumbnail art
     */
    protected $thumbnail;
    /**
     * @ORM\Column(type="string", length=255) #Link to full size art
     */
    protected $artwork;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serial
     *
     * @param string $serial
     * @return Release
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;

        return $this;
    }

    /**
     * Get serial
     *
     * @return string 
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Release
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set artist
     *
     * @param string $artist
     * @return Release
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set length
     *
     * @param float $length
     * @return Release
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return float 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Release
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Release
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tracks
     *
     * @param string $tracks
     * @return Release
     */
    public function setTracks($tracks)
    {
        $this->tracks = $tracks;

        return $this;
    }

    /**
     * Get tracks
     *
     * @return string 
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * Set download
     *
     * @param string $download
     * @return Release
     */
    public function setDownload($download)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return string 
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return Release
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set artwork
     *
     * @param string $artwork
     * @return Release
     */
    public function setArtwork($artwork)
    {
        $this->artwork = $artwork;

        return $this;
    }

    /**
     * Get artwork
     *
     * @return string 
     */
    public function getArtwork()
    {
        return $this->artwork;
    }
}
