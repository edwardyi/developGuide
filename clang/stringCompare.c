#include <cs50.h>
#include <stdio.h>
#include <string.h>

bool compare_strings(string a, string b);

int main(void) {
    string s = get_string("s:");
    string t = get_string("t:");

    if (compare_strings(s, t)) {
        printf("Same");
    }
    else {
        printf("Different");
    }
}

bool compare_strings(string a, string b) {
    if (strlen(a) != strlen(b)) {
        return false;
    }
    for(int i=0, s = strlen(a); i<s; i ++ ){
        if (a[i] != b[i]) {
            return false;
        }
    }

    return true;
}
