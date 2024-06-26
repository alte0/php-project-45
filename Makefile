brain-games:
	./bin/brain-games
brain-even:
	./bin/brain-even
brain-calc:
	./bin/brain-calc
brain-gcd:
	./bin/brain-gcd
brain-progression:
	./bin/brain-progression
brain-prime:
	./bin/brain-prime
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
c-d-a:
	composer dump-autoload
c-i:
	composer install
c-v:
	composer validate
c-r:
	composer require $(filter-out $@,$(MAKECMDGOALS))
c-r-dev:
	composer require --dev $(filter-out $@,$(MAKECMDGOALS))