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

    public function beforeTraverse(array $nodes)
    {
        return null;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $this->handleNamespace($node);
        } elseif ($node instanceof Node\Stmt\Class_) {
            $this->handleClass($node);
        } elseif ($node instanceof Node\Stmt\Function_) {
            $this->handleFunction($node);
        } elseif ($node instanceof Node\Stmt\Const_) {
            $this->handleConstant($node);
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
                                  'extends'=>$classHint->getExtends(),
                                  'methods'=>$classHint->getMethods(), 'properties'=>$classHint->getProperties(),
                                  'constants'=>$classHint->getConstants()];
        }
    }

    private function handleFunction(Node\Stmt\Function_ $function)
    {
        $functionHint = new FunctionHint;

        $functionHint->setStmtType("Function");
        $functionHint->setName($function->name);

        $this->fileStmts[] = ['stmtType'=>$functionHint->getStmtType(), 'name'=>$functionHint->getName()];
    }

    private function handleNamespace(Node\Stmt\Namespace_ $namespace)
    {
        $namespaceHint = new NamespaceHint;

        $namespaceHint->setStmtType("Namespace");
        $namespaceHint->setName($namespace->name->toString());

        $this->fileStmts[] = ['stmtType'=>$namespaceHint->getStmtType(), 'name'=>$namespaceHint->getName()];
    }

    private function handleConstant(Node\Stmt\Const_ $constant)
    {

        $constantHint = new NamespaceHint;
        $constantHint->setStmtType("Constant");
        $constantHint->setName($constant->name);

        $this->fileStmts[] = ['stmtType'=>$constantHint->getStmtType(), 'name'=>$constantHint->getName()];
    }
}
