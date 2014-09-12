<?php

namespace PhpCodeHints;

use PhpParser\Node;
use PhpParser\Comment;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpCodeHints\ClassHint;
use PhpCodeHints\NamespaceHint;
use PhpCodeHints\ConstantHint;
use PhpCodeHints\FunctionHint;

class HintVisitor extends NodeVisitorAbstract
{
    public $fileStmts = [];

    private $namespace = "";

    public function beforeTraverse(array $nodes)
    {
        return null;
    }

    public function enterNode(Node $node)
    {
        $blah = "";
        if ($node instanceof Node\Stmt\Namespace_) {
            $this->handleNamespace($node);
        } elseif ($node instanceof Node\Stmt\Class_) {
            $this->handleClass($node);
        } elseif ($node instanceof Node\Stmt\Function_) {
            $this->handleFunction($node);
        } elseif ($node instanceof Node\Stmt\Const_) {
            $this->handleConstant($node);
        } elseif ($node instanceof Node\Expr\FuncCall
                 && $node->name instanceof Node\Name
                 && $node->name == 'define') {
            $this->handleDefine($node);
        }
        return null;
    }

    public function leaveNode(Node $node)
    {
        return null;
    }

    public function afterTraverse(array $nodes)
    {
        return null;
    }

    private function handleClass(Node\Stmt\Class_ $class)
    {
        $classHint = new ClassHint;

        if (!$class->isAbstract()) {
            $classHint->setStmtType("Class");
            $classHint->setName($class->name);
            $classHint->setFqn($this->namespace . "\\" . $class->name);
            $classHint->setClassType($class->type);
            if ($class->extends instanceof Node) {
                $classHint->setExtends($class->extends->toString());
            }

            foreach ($class->stmts as $stmt) {
                $paramNames = [];
                $docComment = null;
                if ($stmt instanceof Node\Stmt\ClassMethod && $stmt->isPublic()) {
                    foreach ($stmt->params as $param) {
                        $paramNames[] = $param->name;
                    }
                    $docComment = $stmt->getDocComment();
                    if ($docComment !== null) {
                        $docComment = $docComment->getReformattedText();
                    }
                    $classHint->addMethod($stmt->name, $stmt->type, $paramNames, $docComment);
                }
                if ($stmt instanceof Node\Stmt\Property && $stmt->isPublic()) {
                    $docComment = $stmt->getDocComment();
                    if ($docComment !== null) {
                        $docComment = $docComment->getReformattedText();
                    }
                    $classHint->addProperty($stmt->props, $docComment);
                }
                if ($stmt instanceof Node\Stmt\ClassConst) {
                    $docComment = $stmt->getDocComment();
                    if ($docComment !== null) {
                        $docComment = $docComment->getReformattedText();
                    }
                    $classHint->addConstant($stmt->consts, $docComment);
                }
            }

            $this->fileStmts[] = ['stmtType'=>$classHint->getStmtType(), 'name'=>$classHint->getName(),
                                  'fqn'=>$classHint->getFqn(),
                                  'type'=>$classHint->getClassType(), 'extends'=>$classHint->getExtends(),
                                  'methods'=>$classHint->getMethods(), 'properties'=>$classHint->getProperties(),
                                  'constants'=>$classHint->getConstants()];
        }
    }

    private function handleFunction(Node\Stmt\Function_ $function)
    {
        $functionHint = new FunctionHint;

        $functionHint->setStmtType("Function");
        $functionHint->setName($function->name);
        $functionHint->setParams($function->params);

        $this->fileStmts[] = ['stmtType'=>$functionHint->getStmtType(), 'name'=>$functionHint->getName(),
                              'params'=>$functionHint->getParams()];
    }

    private function handleNamespace(Node\Stmt\Namespace_ $namespace)
    {
        $this->namespace = $namespace->name->toString();
        $namespaceHint = new NamespaceHint;

        $namespaceHint->setStmtType("Namespace");
        $namespaceHint->setName($namespace->name->toString());

        $this->fileStmts[] = ['stmtType'=>$namespaceHint->getStmtType(), 'name'=>$namespaceHint->getName()];
    }

    private function handleConstant(Node\Stmt\Const_ $constants)
    {
        $consts = $constants->consts;
        foreach ($consts as $constant) {
            $constantHint = new ConstantHint;
            $constantHint->setStmtType("Constant");
            $constantHint->setName($constant->name);
            $constantHint->setValue($constant->value->value);
            $this->fileStmts[] = ['stmtType'=>$constantHint->getStmtType(), 'name'=>$constantHint->getName(),
                                 'value'=>$constantHint->getValue()];
        }
    }

    private function handleDefine(Node\Expr\FuncCall $define)
    {
        $constantHint = new ConstantHint;
        $constantHint->setStmtType("Constant");
        $constantHint->setName($define->args[0]->value->value);
        $constantHint->setValue($define->args[1]->value->value);
        $this->fileStmts[] = ['stmtType'=>$constantHint->getStmtType(), 'name'=>$constantHint->getName(),
                             'value'=>$constantHint->getValue()];
    }
}
