<?php

namespace CybozuHttp\Api\User;

use CybozuHttp\Client;
use CybozuHttp\Api\UserApi;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class UserOrganizations
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Csv
     */
    private $csv;

    public function __construct(Client $client, Csv $csv)
    {
        $this->client = $client;
        $this->csv = $csv;
    }

    /**
     * Get organizations and titles of user
     * https://cybozudev.zendesk.com/hc/ja/articles/202124774#step2
     *
     * @param string $code
     * @return array
     */
    public function get($code)
    {
        $options = ['json' => ['code' => $code]];

        return $this->client
            ->get(UserApi::generateUrl('user/organizations.json'), $options)
            ->json()['organizationTitles'];
    }

    /**
     * Get userOrganizations by csv
     * https://cybozudev.zendesk.com/hc/ja/articles/202124774#step1
     *
     * @return string
     */
    public function getByCsv()
    {
        return $this->csv->get('userOrganizations');
    }

    /**
     * Post userOrganizations by csv
     * https://cybozudev.zendesk.com/hc/ja/articles/202362860
     *
     * @param $filename
     * @return int
     */
    public function postByCsv($filename)
    {
        return $this->csv->post('userOrganizations', $filename);
    }
}