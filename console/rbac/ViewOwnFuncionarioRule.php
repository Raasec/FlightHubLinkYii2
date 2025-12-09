<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace console\rbac;

use yii\rbac\Rule;
use yii\rbac\Item;

/**
 * Rule represents a business constraint that may be associated with a role, permission or assignment.
 *
 * For more details and usage information on Rule, see the [guide article on security authorization](guide:security-authorization).
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class ViewOwnFuncionarioRule extends Rule
{
    /**
     * @var string name of the rule
     */

    // Definação do Nome da Rule
    public $name = 'isOwnFuncionario';


    /**
     * @var int UNIX timestamp representing the rule creation time
     */
    
    public $createdAt;
    /**
     * @var int UNIX timestamp representing the rule updating time
     */
    
    public $updatedAt;

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */

    // Lógica da Rule a ser aplicada:
    // Fazer a verificação se o Funcionario é o próprio
    public function execute($user, $item, $params)
    {
        return isset($params['model']) &&
               $params['model']->id_utilizador == $user;
    }


}