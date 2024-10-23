import { ChartConfig } from '@/Components/UI/Chart';

export const createChartConfig = <T extends Record<string, any>>(
    data: T[],
    nameKey: keyof T,
) => {
    const chartConfig: ChartConfig = {};

    data.forEach((item, index) => {
        const formattedKey = String(item[nameKey])
            .toLowerCase()
            .replace(/\s+/g, '_');

        chartConfig[formattedKey] = {
            label: String(item[nameKey]),
            color: `var(--chart-${index + 1})`,
        };
    });

    return chartConfig;
};
