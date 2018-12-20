<?php
namespace yellowheroes\bootwrap\libs;

/**
 * Class Documentor
 * prepares formatted documentation for a class.
 *
 * use Documentor::getDoc() to retrieve the formatted class documentation
 * each array element contains a string:
 *              - method docblock
 *              - method signature
 * the first aray element contains the class-level docblock (if it exists).
 *
 * use Documentor::dumpDoc() render human-readable array with class documentation
 *
 * @package yellowheroes\bootwrap
 */
class Documentor
{
    public $reflectClass = null;
    public $docStore = []; // the documentation store (raw)
    public $documentation = []; // formatted documentation for client-side rendering

    /**
     * Documentor constructor.
     *
     * @param $object
     *
     * @throws \ReflectionException
     */
    public function __construct($object)
    {
        $this->reflectClass = new \ReflectionClass($object); // use reflection on class
        $invoke = $this->makeDoc($object); // prepare raw class documentation - store in $this->docStore
        $invoke = $this->setDoc(); // formatted class documentation - store in $this->documentation
    }

    /**
     * makeDoc() prepares formatted documentation consisting of
     * a DocBlock with method signature for each method in the class.
     *
     * @param $object
     *
     * @return void
     * @throws \ReflectionException
     */
    public function makeDoc($object): void
    {
        /* the store for all class docblocks and method signatures */
        $store = [];

        /* store class-level DocBlock */
        $classDocComment = $this->reflectClass->getDocComment(); // get the class-level DocBlock
        $store[] = \explode(PHP_EOL, $classDocComment); // store the class-level DocBlock

        /*
         * store method DocBlocks and method signatures in temporary store
         * they still need reformatting before they go into final store
         */
        $storeTemp = []; // intermediate store
        $c = 0;
        $classMethods = \get_class_methods($object); // store all class methods in array
        \asort($classMethods); // sort class methods alphabetically
        $classMethods = \array_values($classMethods); // rebase classMethods array to 0.
        foreach ($classMethods as $method) {
            $methodDocComment = $this->reflectClass->getMethod($method)->getDocComment();
            $signature = $this->getFunctionSignature($object, $method);
            $storeTemp[$c] = \explode(PHP_EOL, $methodDocComment);
            $storeTemp[$c][] = "\r\n"; // one extra empty line between DocComment and function signature
            $storeTemp[$c][] = $signature; // add the function signature to the temporary store
            $c++;
        }
        /* reformat DocBlocks and put in final store */
        foreach ($storeTemp as $key0 => $value0) {
            foreach ($value0 as $key1 => $value1) {
                if ($value1 !== "/**" &&
                    \substr($value1, 0, 6) !== 'public' &&
                    \substr($value1, 0, 9) !== 'protected' &&
                    \substr($value1, 0, 7) !== 'private') {
                    $store[$key0 + 1][] = substr($value1, 4);
                } else {
                    $store[$key0 + 1][] = $value1;
                }
            }
        }
        $this->docStore = $store; // copy the store to docStore
    }

    /**
     * getFunctionSignature() constructs a method signature using reflection
     *
     * @param object|null $object : class instantiation (an object)
     * @param string|null $method : a class method
     *
     * @return string     $signature : the method signature
     * @throws \ReflectionException
     */
    public function getFunctionSignature($object = null, string $method = null): string
    {
        $parameters = '';
        $funcSignature['method'] = $method;
        $reflectMethod = new \ReflectionMethod($object, $method);
        $publicMethod = ($reflectMethod->isPublic() === true) ? true : false;
        $protectedMethod = ($reflectMethod->isProtected() === true) ? true : false;
        $visibility = ($publicMethod === true) ? 'public' : (($protectedMethod === true) ? 'protected' : 'private');
        $funcSignature['return'] = $reflectMethod->getReturnType();
        $params = $reflectMethod->getParameters();
        foreach ($params as $param) {
            $funcSignature['parameters'][] = $param->getName();
            $funcSignature['optional'][] = $param->isOptional();
            $parameters .= $param->getType() . " $" . $param->getName() . ", ";
        }
        $parameters = \substr($parameters, 0, -2);
        $signature = $visibility . " function " . $funcSignature['method'] . "(" . $parameters . ")";

        return $signature;
    }

    /**
     * render the complete formatted class documentation
     *
     * @return void
     */
    public function dumpDoc(): void
    {
        /* render formatted class documentation */
        \print_r($this->documentation);
    }

    /**
     * store formatted class documentation in array ($this->documentation)
     * each array element holds a string with 1 docblock and 1 method signature
     *
     * @return void
     */
    public function setDoc(): void
    {
        /* format class documentation for echoing */
        foreach ($this->docStore as $key0 => $value0) {
            $docBlock = \implode("\r\n", $value0); // glue DocBlock lines back together
            $this->documentation[] = "<pre>" . $docBlock . "</pre>"; // wrap each docblock in <pre> block
        }
    }

    /**
     * return the formatted class documentation
     * each array element contains a docblock and a method signature.
     *
     * @return array : the formatted documentation ready for echoing
     */
    public function getDoc(): array
    {
        return $this->documentation;
    }

    /**
     * return the raw (unformatted) class documentation
     *
     * @return array : the unformatted documentation
     */
    public function getRaw(): array
    {
        return $this->docStore;
    }
}