<?php
    class Offers {

        /**
         * store generated offers
         * @var array
         */
        public $offers = [];

        /**
         * Method used to generate dummy offers
         * @param bool / int $totalOffers
         * @return array
         */
        public function generateOffers($totalOffers = false) {
            //if total offers not defined , take a random number between 50,100
            if ($totalOffers == false) {
                $totalOffers = rand(50,100);
            }

            $offers = [];
            for ($i = 0; $i < $totalOffers; $i++) {
                $offers[$i]['productName'] = self::generateName(10)."_$i";
                $offers[$i]['productCode'] = "code_$i".self::generateName(3);
                $offers[$i]['productPrice'] = rand(100,1000);
            }
            return $offers;
        }

        /**
         * Method used to generate a random name
         * @param int $length
         * @return string
         */
        private static function generateName( $length = 10 ) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYQ0123456789";
            $name = '';
            for ($i = 0; $i < $length; $i++) {
                $name .= $chars[rand(0, strlen($chars)-1)];
            }
            return $name;
        }
    }