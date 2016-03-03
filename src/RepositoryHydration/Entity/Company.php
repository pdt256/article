<?php
namespace pdt256\RepositoryHydration\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Trinet\Time\Repository\DoctrineCompanyRepository")
 * @ORM\Table(
 *     name="companies",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="key_idx", columns={"key"})}
 * )
 */
class Company implements EntityInterface
{
    use IdTrait;

    /**
     * @var string
     * @ORM\Column(name="key", type="string", length=20, nullable=false, options={"default": ""})
     */
    protected $key;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=100, nullable=false, options={"default": ""})
     */
    protected $name;

    /**
     * ISO 3166-1 alpha-2 code
     * @var string
     * @ORM\Column(name="country_iso", type="string", length=2, nullable=false, options={"default": "US"})
     */
    protected $countryCode;

    /**
     * @var string
     * @ORM\Column(name="phone_main", type="string", length=100, nullable=false, options={"default": ""})
     */
    protected $businessPhone;

    /**
     * @var string
     * @ORM\Column(name="phone_fax", type="string", length=100, nullable=false, options={"default": ""})
     */
    protected $businessFax;

    /**
     * @var string
     * @ORM\Column(name="url", type="string", length=100, nullable=false, options={"default": ""})
     */
    protected $websiteUrl;

    /**
     * @var string
     * @ORM\Column(name="company_code", type="string", length=100, nullable=false, options={"default": ""})
     */
    protected $companyCode;

    /**
     * @var string
     * @ORM\Column(name="naics_sic_code", type="string", length=100, nullable=false, options={"default": ""})
     */
    protected $naicsSicCode;

    /**
     * @var string
     * @ORM\Column(name="sector", type="string", length=100, nullable=false, options={"default": ""})
     */
    protected $sector;

    /**
     * @var string
     * @ORM\Column(name="wc_admin_pin", type="string", length=10, nullable=true, options={"default": null})
     */
    protected $webClockAdminPIN;

    /**
     * @var bool
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default": 0})
     */
    protected $isActive;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="superadmin_user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var MailingAddress
     * @ORM\Embedded(class="MailingAddress", columnPrefix=false)
     */
    protected $mailingAddress;

    /**
     * @var PayCode[]
     * @ORM\OneToMany(targetEntity="PayCode", mappedBy="company")
     */
    protected $payCodes;

    /**
     * @var LinkedCondition[]
     * @ORM\OneToMany(targetEntity="LinkedCondition", mappedBy="company")
     */
    protected $linkedConditions;

    public function __construct()
    {
        $this->isActive = false;
        $this->payCodes = new ArrayCollection;
        $this->linkedConditions = new ArrayCollection;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = (string) $countryCode;
    }

    public function getBusinessPhone()
    {
        return $this->businessPhone;
    }

    /**
     * @param string $businessPhone
     */
    public function setBusinessPhone($businessPhone)
    {
        $this->businessPhone = (string) $businessPhone;
    }

    public function getBusinessFax()
    {
        return $this->businessFax;
    }

    /**
     * @param string $businessFax
     */
    public function setBusinessFax($businessFax)
    {
        $this->businessFax = (string) $businessFax;
    }

    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    /**
     * @param string $websiteUrl
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = (string) $websiteUrl;
    }

    public function getCompanyCode()
    {
        return $this->companyCode;
    }

    /**
     * @param string $companyCode
     */
    public function setCompanyCode($companyCode)
    {
        $this->companyCode = (string) $companyCode;
    }

    public function getNaicsSicCode()
    {
        return $this->naicsSicCode;
    }

    /**
     * @param string $naicsSicCode
     */
    public function setNaicsSicCode($naicsSicCode)
    {
        $this->naicsSicCode = (string) $naicsSicCode;
    }

    public function getSector()
    {
        return $this->sector;
    }

    /**
     * @param string $sector
     */
    public function setSector($sector)
    {
        $this->sector = (string) $sector;
    }

    public function getWebClockAdminPIN()
    {
        return $this->webClockAdminPIN;
    }

    /**
     * @param string $webClockAdminPIN
     */
    public function setWebClockAdminPIN($webClockAdminPIN)
    {
        $this->webClockAdminPIN = (string) $webClockAdminPIN;
    }

    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = (bool) $isActive;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getMailingAddress()
    {
        return $this->mailingAddress;
    }

    public function setMailingAddress(MailingAddress $mailingAddress)
    {
        $this->mailingAddress = $mailingAddress;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = (string) $key;
    }

    public function getPayCodes()
    {
        return $this->payCodes;
    }

    public function addPayCode(PayCode $payCode)
    {
        $this->payCodes->add($payCode);
    }

    public function getLinkedConditions()
    {
        return $this->linkedConditions;
    }

    public function addLinkedCondition(LinkedCondition $linkedCondition)
    {
        $this->linkedConditions->add($linkedCondition);
    }
}
