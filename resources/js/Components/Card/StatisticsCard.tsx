import { type RemixiconComponentType } from '@remixicon/react';

interface StatisticsCardProps {
    icon?: RemixiconComponentType;
    color: 'orange' | 'blue' | 'green' | 'purple';
    title: string;
    value: string | number;
}

const colorClasses = {
    orange: {
        bg: 'bg-orange-600',
        iconBg: 'bg-orange-100',
        text: 'text-orange-600',
    },
    blue: {
        bg: 'bg-blue-900',
        iconBg: 'bg-blue-100',
        text: 'text-blue-900',
    },
    green: {
        bg: 'bg-green-700',
        iconBg: 'bg-green-100',
        text: 'text-green-700',
    },
    purple: {
        bg: 'bg-purple-700',
        iconBg: 'bg-purple-100',
        text: 'text-purple-700',
    },
};

const StatisticsCard = ({
    icon: Icon,
    color,
    title,
    value,
}: StatisticsCardProps) => {
    return (
        <div
            className={`flex-1 space-y-3 rounded-xl p-4 ${colorClasses[color].bg}`}
        >
            <header className="flex items-center gap-4">
                {Icon && (
                    <div
                        className={`rounded-full border-4 border-white p-1.5 ${colorClasses[color].iconBg}`}
                    >
                        <Icon
                            className={`size-5 ${colorClasses[color].text}`}
                        />
                    </div>
                )}
                <h3 className="text-sm font-medium text-white">{title}</h3>
            </header>
            <div className="rounded-lg border border-white/50 bg-white/30 p-4">
                <p className="text-xl font-bold leading-none text-white">
                    {value}
                </p>
            </div>
        </div>
    );
};

export default StatisticsCard;
