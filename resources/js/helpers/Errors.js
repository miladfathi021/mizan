export default class Errors {
    constructor () {
        this.errors = {};
    }

    records (errors) {
        this.errors = errors;
    }

    has (key) {
        return key in this.errors
    }

    get (key) {
        return this.errors[key][0];
    }
}
