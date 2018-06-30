<?php
class MeetUpApi {
    private $baseUrl = "https://api.meetup.com";
    private $notificationUrl = "/notifications?";
    private $strNofity = "/notifications?"; // &page=20
    private $strEvent = ""; // ?photo-host=public&page=20
    private $config;

    private $nofityUrl = array(
        'photo-host' => "public"
    );

    private $eventUrl = array(
        'photo-host' => "public"
    );

    private function initData() {
        $this->config = parse_ini_file("config.ini");
        $this->nofityUrl = array_merge(
                                $this->nofityUrl, 
                                array(
                                    'sig_id' => $this->config['sig_id'],
                                    'sig' => $this->config['sig_nofity']
                                )
                            );
        $this->eventUrl = array_merge(
                            $this->nofityUrl, 
                            array(
                                'page' => '20',
                                'sig_id' => $this->config['sig_id'],
                                // 'sig' => $this->config['sig_event'],
                                'sign' => 'false'
                            )
                          );
    }
    function setNotifyUrl() {
        $this->strNofity = $this->baseUrl.$this->strNofity.http_build_query($this->nofityUrl);
    }
    function setEventUrl($searchGroupUrlName) {
        $strParam = "/events?"; // concatenate string
        if ($this->eventUrl['sign'] === 'false') {
            unset($this->eventUrl['sig']);
        }
        $this->strEvent = $this->baseUrl.'/'.$searchGroupUrlName.$strParam.http_build_query($this->eventUrl);
    }

    function getNotification(){
        $this->initData();
        $this->setNotifyUrl();
        $result = $this->getUrlDecodeResult($this->strNofity);
        return $this->getNotificationOutput($result);
    }

     function getUrlDecodeResult($url) {
        // var_dump($url); // debug url
        $result = json_decode(@file_get_contents($url));
        if ($result) {
            foreach($result as $key => $event) {
                $result[$key] = (array) $event;
            }
            return $result;
        }
        return array();
    }

   public function getEventOutput($data){
        $result = array();
        if (count($data) === 0) {
            return array(
                'held_date' => '',
                'address' => '',
                'held_place' => '',
                'name' => '',
            );
        }
        foreach ($data as $value) {
            $venue = (array) $value['venue'];
            if (isset($venue['address_2'])) {
                $result[] = array(
                    'held_date' => $value['local_date'] .' '. $value['local_time'],
                    'address' => $venue['address_2'],
                    'held_place' => $venue['name'],
                    'name' => $value['name'],
                );
            }   
        }
        return !empty($result) ? $result[0] : array() ;
    }

    function getNotificationOutput($data){
        $result = array();
        if (count($data) === 0) {
            return array();
        }
        foreach ($data as $key => $value) {
            $target = (array) $value['target'];
            $searchGroupUrlName =  isset($target['group_urlname']) ? $target['group_urlname'] : '';
            if (strpos(strtolower($searchGroupUrlName), 'meetup-group') === 0) {
                continue;
            }
            if ($searchGroupUrlName) {
                $this->setEventUrl($searchGroupUrlName);
                $events = $this->getEventOutput($this->getUrlDecodeResult($this->strEvent));
                if (is_array($events) && @count($events) > 0) {
                    $result[$key] = array(
                        'text' => $value['text'],
                        'link' => $value['link'],
                        'group_urlname' => $searchGroupUrlName,
                        'held_date' => $events['held_date'],
                        'address' => $events['address'],
                        'held_place' => $events['held_place'],
                        'name' => $events['name']
                    );
                }
            }
        }
        return $result;
    }

}
