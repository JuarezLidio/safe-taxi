<?php

namespace App\Services;

class TreeBuilderService
{
    /**
     * Builds a tree from a set of elements.
     *
     * @param array $elements The elements from which the tree will be built.
     * @param int $parentId The ID of the parent element.
     * @param array $managedParent The IDs of managed parent elements.
     * @return array The built tree.
     */

    public function buildTree(array $elements, $parentId = 1, $managedParent = [])
    {
        $branch = [];
        $managedParent[] = $parentId;
        foreach ($elements as $element) {
            if ($element['id'] != 1) {
                if ($element['id_parent'] == $parentId) {
                    if (in_array($element['id'], $managedParent)) {
                        throw new \Exception('Invalid structure given');
                    }
                    $children = $this->buildTree($elements, $element['id'], $managedParent);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
        }
        return $branch;
    }
}
