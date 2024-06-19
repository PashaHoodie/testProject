<?
echo "function without oop:<br>";
function getCornersCount(...$shapeNames) {
    $shapeDetails = [
        'square' => 4,
        'circle' => 0,
    ];

    $output = '';
    foreach ($shapeNames as $shapeName) {
        $shapeName = strtolower($shapeName);
        if (array_key_exists($shapeName, $shapeDetails)) {
            $output .= "$shapeName - {$shapeDetails[$shapeName]} angles<br>";
        } else {
            $output .= "$shapeName - not defined<br>";
        }
    }
    return $output;
}


echo getCornersCount('square', 'circle', 'triangle');

?>
<hr>
<? echo "function with oop:<br>";

abstract class Shape {
    abstract public function getCornerCount(): int;

    public function __toString(): string {
        $cornerCount = $this->getCornerCount();
        $name = $this->getName();
        if ($cornerCount < 0) {
            return "$name - not defined<br>";
        } else {
            return "$name - $cornerCount angles<br>";
        }
    }

    abstract protected function getName(): string;
}

class Square extends Shape {
    public function getCornerCount(): int {
        return 4;
    }

    protected function getName(): string {
        return 'square';
    }
}

class Circle extends Shape {
    public function getCornerCount(): int {
        return 0;
    }

    protected function getName(): string {
        return 'circle';
    }
}

class UnknownShape extends Shape {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getCornerCount(): int {
        return -1;
    }

    protected function getName(): string {
        return $this->name;
    }
}

function getCornersCountOop(...$shapeNames) {
    $shapes = [];
    foreach ($shapeNames as $shapeName) {
        switch ($shapeName) {
            case 'square':
                $shapes[] = new Square();
                break;
            case 'circle':
                $shapes[] = new Circle();
                break;
            default:
                $shapes[] = new UnknownShape($shapeName);
                break;
        }
    }

    $output = '';
    foreach ($shapes as $shape) {
        $output .= (string) $shape;
    }
    return $output;
}

echo getCornersCountOop('square', 'circle', 'triangle');
