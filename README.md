# currency-calc

Aplikacja CurrencyCalc służy do przeliczania kwoty PLN na kwotę w wybranej przez użytkownika walucie.

Formularz aplikacji składa się z 3 pól : select, text, checkbox.
W polu select należy wybrać Stolicę oraz walutę.
W polu text należy wprowadzić kwotę. Kwota musi być większa niż zero i mniejsza niż milion.
Pole checkbox jest opcjonalne i umożliwia wykorzystanie funkcjonalności dodatkowej.

Po naciśnięciu przycisku "oblicz" formularz sprawdza czy wprowadzone dane są poprawne.

Jeżeli wprowadzone dane są poprawne, a checkbox nie został zaznaczony, wykona się podstawowa funkcjonalność aplikacji.
Aplikacja wysyła zapytanie do currencylayer API i na podstawie otrzymanych danych, przelicza kwotę PLN na wybraną przez użytkownika walutę.

Dla przykładu odpowiedź aplikacji na wybranie select : Wiedeń, EUR oraz wpisanie kwoty 1000 PLN to :

"Wiedeń : dysponując 1000 PLN będziesz posiadać 232.75 EUR."

Jeżeli wprowadzone dane są poprawne, a checkbox został zaznaczony, oprócz podstawowej funkcjonalności, wykona się również skrypt python.
Skrypt ma za zadanie przewidzieć średnie miesięczne wartości kursu wybranej waluty na najbliższe 12 miesięcy i wypisać je.
Jako że na kurs waluty wpływa o wiele więcej czynników niż tylko jego poprzednie wartości, 
przez co skrypt nie jest w stanie przewidzieć dokładnych realnych wartości kursu waluty, funkcjonalność dodatkowa ma za zadanie wychwycić miesiąc,
w którym prawdopodobnie istnieje największa możliwa proporcja (waluta wyjściowa / waluta wejściowa) na wcześniej zdefiniowane sezony.

Dla przykładu odpowiedź aplikacji na poprzednio wprowadzone dane :

"Wiedeń : dysponując 1000 PLN będziesz posiadać 232.75 EUR.
Nasze narzędzia statystyczne mówią, że najlepiej wymienić PLN na EUR :
Na sezon letni w okolicach tego miesiąca.
Na sezon zimowy w okolicach grudnia."

Ze względu na sposób inicjalizacji skryptu python nazwy folderów w ścieżce dostepu nie powinny być oddzielane spacjami
