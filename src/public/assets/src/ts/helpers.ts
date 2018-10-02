/**
 * Główny helper dla wszystkich skryptów pomocniczych
 */
namespace Helpers {

    export class Main {

        /**
         * Funkcja testowa
         * @returns string
         */
        public printTest(): string {
            return "działa";
        }

        /**
         * Dump danych 
         * @param data 
         */
        public dump(data: any): void {
            console.log(data);
        }

        /**
         * Dump i przerwanie wątku
         * @param data 
         */
        public dd(data: any): void {
            console.log(data);
            throw new Error('Aborting all scripts');
        }
    }
}
