import { ChartConfig } from '@/Components/UI/Chart';

export const createChartConfig = <T>(
    data: T[],
    nameKey: keyof T,
    dataKey: keyof T,
) => {
    const chartConfig: ChartConfig = {};

    data.forEach((item, index) => {
        chartConfig[String(item[nameKey])] = {
            label: String(item[nameKey]),
            color: `hsl(var(--chart-${index + 1}))`,
        };
    });

    return chartConfig;
};
