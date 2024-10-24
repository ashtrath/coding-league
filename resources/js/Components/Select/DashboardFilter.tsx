import { Sektor } from '@/Pages/Dashboard/Sektor';
import { PageProps } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { RiDownloadLine } from '@remixicon/react';
import Button from '../UI/Button';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '../UI/Select';

interface FilterProps {
    filter: {
        mitra: {
            id: string;
            name_mitra?: string;
            name_company: string;
        }[];
        sektor: Sektor[];
    };
}

const DashboardFilter = () => {
    const { data } = usePage<PageProps<{ data: FilterProps }>>().props;
    const { filter } = data;

    const currentYear = new Date().getFullYear();
    const years = Array.from(
        { length: currentYear - 2020 + 1 },
        (_, i) => 2020 + i,
    ).reverse();

    return (
        <div className="flex items-center gap-4">
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Tahun..." />
                </SelectTrigger>
                <SelectContent>
                    {years.map((year) => (
                        <SelectItem key={year} value={year.toString()}>
                            {year}
                        </SelectItem>
                    ))}
                </SelectContent>
            </Select>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Kuartal..." />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value="Q1">
                        Kuartal 1 (Januari, Febuari, Maret)
                    </SelectItem>
                    <SelectItem value="Q2">
                        Kuartal 2 (April, Mei, Juni)
                    </SelectItem>
                    <SelectItem value="Q3">
                        Kuartal 3 (Juli, Agustus, September)
                    </SelectItem>
                    <SelectItem value="Q4">
                        Kuartal 4 (Oktober, November, Desember)
                    </SelectItem>
                </SelectContent>
            </Select>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Sektor..." />
                </SelectTrigger>
                <SelectContent>
                    {filter.sektor.length > 0 ? (
                        filter.sektor.map((sektor) => (
                            <SelectItem key={sektor.id} value={sektor.id}>
                                {sektor.name}
                            </SelectItem>
                        ))
                    ) : (
                        <SelectItem value="none" disabled>
                            No Data Available
                        </SelectItem>
                    )}
                </SelectContent>
            </Select>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Mitra..." />
                </SelectTrigger>
                <SelectContent>
                    {filter.mitra.length > 0 ? (
                        filter.mitra.map((mitra) => (
                            <SelectItem key={mitra.id} value={mitra.id}>
                                {mitra.name_mitra ?? mitra.name_company}
                            </SelectItem>
                        ))
                    ) : (
                        <SelectItem value="none" disabled>
                            No Data Available
                        </SelectItem>
                    )}
                </SelectContent>
            </Select>
            <Button>Terapkan filter</Button>
            <Button
                variant="secondary"
                className="gap-2 text-green-600"
                asChild
            >
                <Link href={route('dashboard.export.admin')} as="button">
                    <RiDownloadLine className="size-5" />
                    Unduh .csv
                </Link>
            </Button>
            <Button variant="secondary" className="gap-2 text-brand">
                <RiDownloadLine className="size-5" />
                Unduh .pdf
            </Button>
        </div>
    );
};

export default DashboardFilter;
