<?php
/**
 * EventsGET200ResponseInner
 *
 * PHP version 8.1.1
 *
 * @category Class
 * @package  DanskernesDigitaleBibliotek\CMS\Api\Model
 * @author   OpenAPI Generator team
 * @link     https://github.com/openapitools/openapi-generator
 */

/**
 * DPL CMS - REST API
 *
 * The REST API provide by the core REST module.
 *
 * The version of the OpenAPI document: Versioning not supported
 * 
 * Generated by: https://github.com/openapitools/openapi-generator.git
 *
 */

/**
 * NOTE: This class is auto generated by the openapi generator program.
 * https://github.com/openapitools/openapi-generator
 * Do not edit the class manually.
 */

namespace DanskernesDigitaleBibliotek\CMS\Api\Model;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class representing the EventsGET200ResponseInner model.
 *
 * @package DanskernesDigitaleBibliotek\CMS\Api\Model
 * @author  OpenAPI Generator team
 */

class EventsGET200ResponseInner 
{
        /**
     * A unique identifier for the event.
     *
     * @var string|null
     * @SerializedName("uuid")
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Type("string")
     */
    protected ?string $uuid = null;

    /**
     * The event title.
     *
     * @var string|null
     * @SerializedName("title")
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Type("string")
     */
    protected ?string $title = null;

    /**
     * The short event description.
     *
     * @var string|null
     * @SerializedName("description")
     * @Assert\Type("string")
     * @Type("string")
     */
    protected ?string $description = null;

    /**
     * An absolute URL end users should use to view the event at the website.
     *
     * @var string|null
     * @SerializedName("url")
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Type("string")
     */
    protected ?string $url = null;

    /**
     * When the event was created. In ISO 8601 format.
     *
     * @var \DateTime|null
     * @SerializedName("created_at")
     * @Assert\NotNull()
     * @Assert\Type("\DateTime"))
     * @Type("DateTime")
     */
    protected ?\DateTime $createdAt = null;

    /**
     * When the event was last updated. In ISO 8601 format.
     *
     * @var \DateTime|null
     * @SerializedName("updated_at")
     * @Assert\NotNull()
     * @Assert\Type("\DateTime"))
     * @Type("DateTime")
     */
    protected ?\DateTime $updatedAt = null;

    /**
     * Whether the event is marked as relevant for ticket management systems
     *
     * @var bool|null
     * @SerializedName("ticket_manager_relevance")
     * @Assert\Type("bool")
     * @Type("bool")
     */
    protected ?bool $ticketManagerRelevance = null;

    /**
     * @var EventsGET200ResponseInnerImage|null
     * @SerializedName("image")
     * @Assert\Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerImage")
     * @Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerImage")
     */
    protected ?EventsGET200ResponseInnerImage $image = null;

    /**
     * The state of the event.
     *
     * @var string|null
     * @SerializedName("state")
     * @Assert\NotNull()
     * @Assert\Choice({ "TicketSaleNotOpen", "Active", "SoldOut", "Cancelled", "Occurred" })
     * @Assert\Type("string")
     * @Type("string")
     */
    protected ?string $state = null;

    /**
     * @var EventsGET200ResponseInnerDateTime|null
     * @SerializedName("date_time")
     * @Assert\NotNull()
     * @Assert\Valid()
     * @Assert\Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerDateTime")
     * @Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerDateTime")
     */
    protected ?EventsGET200ResponseInnerDateTime $dateTime = null;

    /**
     * The associated library branches.
     *
     * @var string[]|null
     * @SerializedName("branches")
     * @Assert\All({
     *   @Assert\Type("string")
     * })
     * @Type("array<string>")
     */
    protected ?array $branches = null;

    /**
     * @var EventsGET200ResponseInnerAddress|null
     * @SerializedName("address")
     * @Assert\Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerAddress")
     * @Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerAddress")
     */
    protected ?EventsGET200ResponseInnerAddress $address = null;

    /**
     * The tags associated with the event.
     *
     * @var string[]|null
     * @SerializedName("tags")
     * @Assert\All({
     *   @Assert\Type("string")
     * })
     * @Type("array<string>")
     */
    protected ?array $tags = null;

    /**
     * Ticket categories used for the event. Not present for events without ticketing.
     *
     * @var EventsGET200ResponseInnerTicketCategoriesInner[]|null
     * @SerializedName("ticket_categories")
     * @Assert\All({
     *   @Assert\Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerTicketCategoriesInner")
     * })
     * @Type("array<DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerTicketCategoriesInner>")
     */
    protected ?array $ticketCategories = null;

    /**
     * Total number of tickets which can be sold for the event.
     *
     * @var int|null
     * @SerializedName("ticket_capacity")
     * @Assert\Type("int")
     * @Type("int")
     */
    protected ?int $ticketCapacity = null;

    /**
     * @var EventsGET200ResponseInnerSeries|null
     * @SerializedName("series")
     * @Assert\Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerSeries")
     * @Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventsGET200ResponseInnerSeries")
     */
    protected ?EventsGET200ResponseInnerSeries $series = null;

    /**
     * An editorial WYSIWYG/HTML description of the event.
     *
     * @var string|null
     * @SerializedName("body")
     * @Assert\Type("string")
     * @Type("string")
     */
    protected ?string $body = null;

    /**
     * @var EventPATCHRequestExternalData|null
     * @SerializedName("external_data")
     * @Assert\Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventPATCHRequestExternalData")
     * @Type("DanskernesDigitaleBibliotek\CMS\Api\Model\EventPATCHRequestExternalData")
     */
    protected ?EventPATCHRequestExternalData $externalData = null;

    /**
     * Constructor
     * @param array|null $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        if (is_array($data)) {
            $this->uuid = array_key_exists('uuid', $data) ? $data['uuid'] : $this->uuid;
            $this->title = array_key_exists('title', $data) ? $data['title'] : $this->title;
            $this->description = array_key_exists('description', $data) ? $data['description'] : $this->description;
            $this->url = array_key_exists('url', $data) ? $data['url'] : $this->url;
            $this->createdAt = array_key_exists('createdAt', $data) ? $data['createdAt'] : $this->createdAt;
            $this->updatedAt = array_key_exists('updatedAt', $data) ? $data['updatedAt'] : $this->updatedAt;
            $this->ticketManagerRelevance = array_key_exists('ticketManagerRelevance', $data) ? $data['ticketManagerRelevance'] : $this->ticketManagerRelevance;
            $this->image = array_key_exists('image', $data) ? $data['image'] : $this->image;
            $this->state = array_key_exists('state', $data) ? $data['state'] : $this->state;
            $this->dateTime = array_key_exists('dateTime', $data) ? $data['dateTime'] : $this->dateTime;
            $this->branches = array_key_exists('branches', $data) ? $data['branches'] : $this->branches;
            $this->address = array_key_exists('address', $data) ? $data['address'] : $this->address;
            $this->tags = array_key_exists('tags', $data) ? $data['tags'] : $this->tags;
            $this->ticketCategories = array_key_exists('ticketCategories', $data) ? $data['ticketCategories'] : $this->ticketCategories;
            $this->ticketCapacity = array_key_exists('ticketCapacity', $data) ? $data['ticketCapacity'] : $this->ticketCapacity;
            $this->series = array_key_exists('series', $data) ? $data['series'] : $this->series;
            $this->body = array_key_exists('body', $data) ? $data['body'] : $this->body;
            $this->externalData = array_key_exists('externalData', $data) ? $data['externalData'] : $this->externalData;
        }
    }

    /**
     * Gets uuid.
     *
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }



    /**
     * Sets uuid.
     *
     * @param string|null $uuid  A unique identifier for the event.
     *
     * @return $this
     */
    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Gets title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }



    /**
     * Sets title.
     *
     * @param string|null $title  The event title.
     *
     * @return $this
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }



    /**
     * Sets description.
     *
     * @param string|null $description  The short event description.
     *
     * @return $this
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets url.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }



    /**
     * Sets url.
     *
     * @param string|null $url  An absolute URL end users should use to view the event at the website.
     *
     * @return $this
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets createdAt.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }



    /**
     * Sets createdAt.
     *
     * @param \DateTime|null $createdAt  When the event was created. In ISO 8601 format.
     *
     * @return $this
     */
    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Gets updatedAt.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }



    /**
     * Sets updatedAt.
     *
     * @param \DateTime|null $updatedAt  When the event was last updated. In ISO 8601 format.
     *
     * @return $this
     */
    public function setUpdatedAt(?\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Gets ticketManagerRelevance.
     *
     * @return bool|null
     */
    public function isTicketManagerRelevance(): ?bool
    {
        return $this->ticketManagerRelevance;
    }



    /**
     * Sets ticketManagerRelevance.
     *
     * @param bool|null $ticketManagerRelevance  Whether the event is marked as relevant for ticket management systems
     *
     * @return $this
     */
    public function setTicketManagerRelevance(?bool $ticketManagerRelevance = null): self
    {
        $this->ticketManagerRelevance = $ticketManagerRelevance;

        return $this;
    }

    /**
     * Gets image.
     *
     * @return EventsGET200ResponseInnerImage|null
     */
    public function getImage(): ?EventsGET200ResponseInnerImage
    {
        return $this->image;
    }



    /**
     * Sets image.
     *
     * @param EventsGET200ResponseInnerImage|null $image
     *
     * @return $this
     */
    public function setImage(?EventsGET200ResponseInnerImage $image = null): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Gets state.
     *
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }



    /**
     * Sets state.
     *
     * @param string|null $state  The state of the event.
     *
     * @return $this
     */
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Gets dateTime.
     *
     * @return EventsGET200ResponseInnerDateTime|null
     */
    public function getDateTime(): ?EventsGET200ResponseInnerDateTime
    {
        return $this->dateTime;
    }



    /**
     * Sets dateTime.
     *
     * @param EventsGET200ResponseInnerDateTime|null $dateTime
     *
     * @return $this
     */
    public function setDateTime(?EventsGET200ResponseInnerDateTime $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Gets branches.
     *
     * @return string[]|null
     */
    public function getBranches(): ?array
    {
        return $this->branches;
    }



    /**
     * Sets branches.
     *
     * @param string[]|null $branches  The associated library branches.
     *
     * @return $this
     */
    public function setBranches(?array $branches = null): self
    {
        $this->branches = $branches;

        return $this;
    }

    /**
     * Gets address.
     *
     * @return EventsGET200ResponseInnerAddress|null
     */
    public function getAddress(): ?EventsGET200ResponseInnerAddress
    {
        return $this->address;
    }



    /**
     * Sets address.
     *
     * @param EventsGET200ResponseInnerAddress|null $address
     *
     * @return $this
     */
    public function setAddress(?EventsGET200ResponseInnerAddress $address = null): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Gets tags.
     *
     * @return string[]|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }



    /**
     * Sets tags.
     *
     * @param string[]|null $tags  The tags associated with the event.
     *
     * @return $this
     */
    public function setTags(?array $tags = null): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Gets ticketCategories.
     *
     * @return EventsGET200ResponseInnerTicketCategoriesInner[]|null
     */
    public function getTicketCategories(): ?array
    {
        return $this->ticketCategories;
    }



    /**
     * Sets ticketCategories.
     *
     * @param EventsGET200ResponseInnerTicketCategoriesInner[]|null $ticketCategories  Ticket categories used for the event. Not present for events without ticketing.
     *
     * @return $this
     */
    public function setTicketCategories(?array $ticketCategories = null): self
    {
        $this->ticketCategories = $ticketCategories;

        return $this;
    }

    /**
     * Gets ticketCapacity.
     *
     * @return int|null
     */
    public function getTicketCapacity(): ?int
    {
        return $this->ticketCapacity;
    }



    /**
     * Sets ticketCapacity.
     *
     * @param int|null $ticketCapacity  Total number of tickets which can be sold for the event.
     *
     * @return $this
     */
    public function setTicketCapacity(?int $ticketCapacity = null): self
    {
        $this->ticketCapacity = $ticketCapacity;

        return $this;
    }

    /**
     * Gets series.
     *
     * @return EventsGET200ResponseInnerSeries|null
     */
    public function getSeries(): ?EventsGET200ResponseInnerSeries
    {
        return $this->series;
    }



    /**
     * Sets series.
     *
     * @param EventsGET200ResponseInnerSeries|null $series
     *
     * @return $this
     */
    public function setSeries(?EventsGET200ResponseInnerSeries $series = null): self
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Gets body.
     *
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }



    /**
     * Sets body.
     *
     * @param string|null $body  An editorial WYSIWYG/HTML description of the event.
     *
     * @return $this
     */
    public function setBody(?string $body = null): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Gets externalData.
     *
     * @return EventPATCHRequestExternalData|null
     */
    public function getExternalData(): ?EventPATCHRequestExternalData
    {
        return $this->externalData;
    }



    /**
     * Sets externalData.
     *
     * @param EventPATCHRequestExternalData|null $externalData
     *
     * @return $this
     */
    public function setExternalData(?EventPATCHRequestExternalData $externalData = null): self
    {
        $this->externalData = $externalData;

        return $this;
    }
}


