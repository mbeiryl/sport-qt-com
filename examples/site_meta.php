<?php

/**
 * Site Metadata Utility
 * 
 * Provides structured storage for site information and a method 
 * to generate a concise description string.
 */

class SiteMetaData
{
    private string $siteName;
    private string $siteUrl;
    private string $description;
    private array $keywords;
    private string $language;
    private string $charset;
    private bool $isActive;

    public function __construct(
        string $siteName,
        string $siteUrl,
        string $description,
        array $keywords,
        string $language = 'zh-CN',
        string $charset = 'UTF-8',
        bool $isActive = true
    ) {
        $this->siteName = $siteName;
        $this->siteUrl = $siteUrl;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->language = $language;
        $this->charset = $charset;
        $this->isActive = $isActive;
    }

    /**
     * Generate a short descriptive text based on stored metadata.
     *
     * @return string
     */
    public function generateDescription(): string
    {
        $parts = [];

        if ($this->isActive && !empty($this->siteName)) {
            $parts[] = $this->siteName;
        }

        if (!empty($this->description)) {
            $parts[] = $this->description;
        }

        if (!empty($this->keywords)) {
            $keywordStr = implode(', ', $this->keywords);
            $parts[] = '关键词：' . $keywordStr;
        }

        if (!empty($this->siteUrl)) {
            $parts[] = '网址：' . $this->siteUrl;
        }

        return htmlspecialchars(implode(' — ', $parts), ENT_QUOTES, $this->charset);
    }

    /**
     * Get site URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * Get site name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->siteName;
    }

    /**
     * Get all keywords as an array.
     *
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Check if the site is marked as active.
     *
     * @return bool
     */
    public function isActiveSite(): bool
    {
        return $this->isActive;
    }
}

// Example usage
$meta = new SiteMetaData(
    '球探体育',
    'https://sport-qt.com',
    '提供专业的体育赛事分析与实时数据服务',
    ['球探', '体育数据', '赛事分析'],
    'zh-CN',
    'UTF-8',
    true
);

echo $meta->generateDescription();