Gerar quiz
==================

Como utilizar
-----------

Antes de utilizar é necessário gerar os arquivos de autoload com o composer dump-autoload no mesmo diretório do arquivo composer.json

Após isto é só enviar as questões para a entrada padrão do script.

Ex. (Na raiz do projeto)

```
cat ./questions/**/*  | php ./faas/quiz_generator/index.php > chapter-1-quiz.html
```