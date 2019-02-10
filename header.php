<?php
    interface Element
    {
        public function __toString();
    }

    interface PageBlock
    {
        public function draw();
    }

    class Head implements PageBlock {
        private $elements = [];
        private $page_title;

        function __construct() {
        }

        function add_element(Element $element) {
            array_push($this->$elements, $element);
        }

        function set_title(string $title) { $this->page_title = $title; }

        function draw() {
            echo ("<head>");

            // Stampa il titolo se esiste
            if (isset($this->page_title)) {
                echo ("<title>".$this->page_title."</title>");
            }

            // Stampa ogni elemento
            foreach ($this->elements as $element) {
                echo ((string) $element);
            }

            echo ("</head>");
        }
    }
?>