import { RiArrowLeftLine, RiArrowRightLine } from '@remixicon/react';
import { Table } from '@tanstack/react-table';
import Button from '../Button';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '../Select';
import { generatePaginationLinks } from './generatePaginationPages';

interface DataTablePaginationProps<TData> {
    table: Table<TData>;
    pageSizeOptions?: number[];
}

export function DataTablePagination<TData>({
    table,
    pageSizeOptions = [5, 10, 20],
}: DataTablePaginationProps<TData>) {
    const { pageIndex, pageSize } = table.getState().pagination;

    const rowCount = table.getRowCount();

    const startIndex = pageIndex * pageSize + 1;
    const endIndex = Math.min((pageIndex + 1) * pageSize, rowCount);

    return (
        <div className="flex items-center justify-between rounded-xl rounded-t-none border-t-2 border-gray-300 bg-white px-6 pb-4 pt-3 text-gray-900">
            <div className="flex items-center gap-4">
                <p className="text-sm font-medium text-gray-600">
                    Tampilkan Data
                </p>
                <Select
                    value={`${table.getState().pagination.pageSize}`}
                    onValueChange={(value) => {
                        table.setPageSize(Number(value));
                    }}
                >
                    <SelectTrigger className="w-fit gap-2">
                        <SelectValue
                            placeholder={table.getState().pagination.pageSize}
                        />
                    </SelectTrigger>
                    <SelectContent side="top">
                        {pageSizeOptions.map((pageSize) => (
                            <SelectItem key={pageSize} value={`${pageSize}`}>
                                {pageSize}
                            </SelectItem>
                        ))}
                    </SelectContent>
                </Select>

                <p className="text-sm font-medium text-gray-600">
                    {startIndex}-{endIndex} data dari {rowCount} data.
                </p>
            </div>
            <div className="flex items-center justify-end gap-2">
                <nav role="navigation" aria-label="pagination">
                    <ul className="flex flex-row items-center">
                        <li className="hover:cursor-pointer">
                            <Button
                                variant="secondary"
                                onClick={() => table.previousPage()}
                                disabled={!table.getCanPreviousPage()}
                                className="gap-2 rounded-r-none"
                            >
                                <RiArrowLeftLine className="size-5" />
                                Sebelumnya
                            </Button>
                        </li>

                        {generatePaginationLinks(
                            table.getState().pagination.pageIndex + 1,
                            table.getPageCount(),
                            (pageNumber: number) =>
                                table.setPageIndex(pageNumber - 1),
                        )}

                        <li className="hover:cursor-pointer">
                            <Button
                                variant="secondary"
                                onClick={() => table.nextPage()}
                                disabled={!table.getCanNextPage()}
                                className="gap-2 rounded-l-none"
                            >
                                Selanjutnya
                                <RiArrowRightLine className="size-5" />
                            </Button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    );
}
