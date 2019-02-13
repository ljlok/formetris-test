<?php
namespace MyLegacyProject\Manager\Helper;

/**
 * Helper class, provides utils
 * @author Jialiang
 *
 */
class Helper
{

    const PARIS_18_ARRDT = 'PARIS 18E ARRDT';

    /**
     *
     * Load data from JSON file
     * @param $filename
     * @return array
     * @throws HelperException
     */
    function loadJsonData($filename) {
        if (!file_exists($filename)) {
            throw new HelperException('File not found');
        }else {
            $trees = json_decode(file_get_contents($filename), true);
            return $trees;
        }
    }

    /**
     * Returns the custom tree rating
     *
     * @param array $treeDetails
     * @return string
     */
    function customTreeRating($treeDetails) {
        $fields = isset($treeDetails['fields']) ? $treeDetails['fields'] : null;
        if ($fields) {
            if (isset($fields['arrondissement']) && $fields['arrondissement'] == self::PARIS_18_ARRDT) {
                return 'C';
            } else if (isset($fields['hauteurenm']) && $fields['circonferenceencm'] &&
                ($fields['hauteurenm'] * 100 + $fields['circonferenceencm']) > 4000) {
                return 'A';
            } else {
                return 'B';
            }
        }
        return 'null';
    }

    private function compareRating($a, $b) {
        $ratingA = $this->customTreeRating($a);
        $ratingB = $this->customTreeRating($b);
        if ($ratingA == $ratingB) return 0;
        return ($ratingA < $ratingB) ? -1 : 1;

    }

    /**
     * Returns the custom tree rating
     *
     * @param array $treeList
     * @param bool $ascending
     * @return array
     */
   function sortByCustomRating($treeList, $ascending=true) {
        usort($treeList, array($this, 'compareRating'));
        return $ascending ? $treeList : array_reverse($treeList);
    }

    /**
     * Returns the random trees
     * @param $treeList
     * @param string $rating gets from rating 'A' 'B' or 'C'
     * @return mixed
     */
    function getRandomTree($treeList, $rating='A') {

        $subArray = array();
        foreach ($treeList as $tree) {
            if ($this->customTreeRating($tree) == $rating) {
                array_push($subArray, $tree);
            }
        }
        $index = array_rand($subArray, 1);
        return $subArray[$index];

    }

    function show($tree) {
        echo "<tr><td>".$tree['fields']['genre']."</td>
<td>".$tree['fields']['espece']."</td>
<td>".(isset($tree['fields']['dateplantation']) ? $tree['fields']['dateplantation'] : '?')."</td>
<td>".$tree['fields']['adresse']. "(".$tree['fields']['arrondissement'].")</td>
<td>".$tree['fields']['hauteurenm']."</td>
<td>".($this->customTreeRating($tree))."</td>
</tr>";
    }



}