<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Person
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property \App\Enums\Gender $gender
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $children
 * @property-read int|null $children_count
 * @property-read Person|null $parent
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read Person|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Person[] $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person depthFirst()
 * @method static \Database\Factories\PersonFactory factory($count = null, $state = [])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person newModelQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person newQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person query()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person whereGender($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person whereId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person whereName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person whereParentId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Person withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Person extends \Eloquent {}
}

