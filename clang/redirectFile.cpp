#define LOCAL
#include<stdio.h>
#define INF 1000000000
int main()
{
#ifdef LOCAL
	freopen("data.in", "r", stdin);
	freopen("data.out", "w", stdout);
#endif
    // 變數初始化都是未知的數字 
	int x, n = 0, min = INF, max = -INF, s =0;
	// 每次都監看是否有新的輸入
	while(scanf("%d", &x) == 1) {
		// 計算加總
		s = s + x;
		if (x < min) min = x;
		if (x > max) max = x;
		// 遞增
		n = n + 1;
	}
	
	
	printf("x= %d, min=%d, max = %d \n",x ,min, max);
	printf("%d %d %.3f\n", min, max, (double) s/n);
	return 0;
}
